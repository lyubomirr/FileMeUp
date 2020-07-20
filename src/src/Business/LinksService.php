<?php 
    require_once(Config::constructFilePath("/Models/Entities/Link.php"));
    require_once(Config::constructFilePath("/Models/Dto/ErrorResult.php"));
    require_once(Config::constructFilePath("/Models/Dto/LinkSettings.php"));
    require_once(Config::constructFilePath("/DataAccess/LinkRepository.php"));
    require_once(Config::constructFilePath("/DataAccess/FileRepository.php"));

    class LinksService {
        private $linkRepository;
        private $fileRepository;

        public function __construct()
        {
            $this->linkRepository = new LinkRepository();
            $this->fileRepository = new FileRepository();
        }

        public function getLink($linkToken) {
            $link = $this->linkRepository->getLink($linkToken);

            if (is_null($link))
                return null;

            if(!is_null($link->sharesLeft) && $link->sharesLeft < 1) {
                $this->linkRepository->deleteLink($link->id);
                return null;
            }

            if(!is_null($link->validUntil) && strtotime($link->validUntil) < time()) {
                $this->linkRepository->deleteLink($link->id);
                return null;
            }

            return $link;
        }
        
        public function generateLink($linkSettings)
        {
            $link = new Link();
            $link->token = sha1(mt_rand(1, 90000));
            $link->fileId = $linkSettings->fileId;

            if(trim($linkSettings->password) !== '')
                $link->password = password_hash($linkSettings->password, PASSWORD_DEFAULT);

            if(trim($linkSettings->validUntil) !== '')
                $link->validUntil = $linkSettings->validUntil;

            if(trim($linkSettings->count) !== '')
                $link->sharesLeft = $linkSettings->count;

            try {
                $this->linkRepository->addLink($link);
                return $link->token;  

            } catch (DatabaseExecutionException $e) {
                return new ErrorResult([
                    $e->getMessage()
                ]);
            }
        }

        public function validatePassword($linkToken, $password) {
            $link = $this->linkRepository->getLink($linkToken);

            if(!password_verify($password, $link->password)) {
                throw new AuthenticationException("Link's password is incorrect.");
            }

            return true;
        }

        public function getFileByToken($linkToken) {
            $link = $this->linkRepository->getLink($linkToken);
            $link->sharesLeft--;

            $this->linkRepository->updateLink($link);

            return $this->fileRepository->getFile($link->fileId);
        }

        public function getOrCreatePermanentTokenForFile($fileId) {
            $token = $this->linkRepository->getPermanentLinkToken($fileId);
            if(!is_null($token)) {
                return $token;
            }

            $settings = new LinkSettings($fileId);
            return $this->generateLink($settings);
        }
    }
?>
