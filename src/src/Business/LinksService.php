<?php 
    require_once(Config::constructFilePath("/Models/Entities/Link.php"));
    require_once(Config::constructFilePath("/Models/Dto/ErrorResult.php"));
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
            return $this->linkRepository->getLink($linkToken);
        }
        
        public function generateLink($linkSettings)
        {
            $link = new Link();
            $link->token = sha1(mt_rand(1, 90000));
            $link->fileId = $linkSettings->fileId;
            //TODO
            $link->user = "";

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

            return $this->fileRepository->getFile($link->fileId);
        }
    }
?>