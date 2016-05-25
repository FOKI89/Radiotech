<?php

class RadiotechUploader
{
    private $host;
    private $user;
    private $password;

    private $ftp;

    public function __construct($host, $user, $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;

        $this->ftp = $this->getConnectionFTP();
    }

    /**
     * Upload the file
     *
     * @param int $user_id id use for directory
     * @param string $file path of file to upload in ftp
     * @return bool
     * @throws Exception
     */
    public function upload($user_id, $file)
    {
        if (null === $this->ftp) {
            throw new Exception('Connection to FTP failed');
        }

        if (!file_exists($file)) {
            throw new Exception('File not exists');
        }

        $this->createRemoteDir(sprintf('/%s', $user_id));

        $filename = md5(uniqid());
        $remoteFile = sprintf('/%d/%s', $user_id, $filename);

        $upload = @ftp_nb_put($this->ftp, $remoteFile, $file, FTP_BINARY, ftp_size($this->ftp, $remoteFile));

        while (FTP_MOREDATA == $upload) {
            $upload = @ftp_nb_continue($this->ftp);
        }

        if (FTP_FAILED === $upload) {
            throw new Exception('Upload failed');
        }

        return true;
    }

    /**
     * Return ftp stream
     *
     * @return null|resource
     */
    private function getConnectionFTP()
    {
        $ftp = @ftp_connect($this->host);
        $login = @ftp_login($ftp, $this->user, $this->password);
        if (!$ftp || !$login) {
            return null;
        }

        return $ftp;
    }

    private function createRemoteDir($dir)
    {
        @ftp_chdir($this->ftp, '/');
        $parts = explode('/', ltrim($dir, '/'));
        foreach($parts as $part){
            if(!@ftp_chdir($this->ftp, $part)){
                ftp_mkdir($this->ftp, $part);
                ftp_chdir($this->ftp, $part);
            }
        }
    }

    public function __destruct()
    {
        if ($this->ftp) {
            ftp_close($this->ftp);
        }
    }
}
