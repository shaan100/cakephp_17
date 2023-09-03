<?php

declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Filesystem\File;
use Cake\I18n\FrozenTime;
use Cake\Filesystem\Folder;
use Cake\Controller\Component;
use Cake\Collection\Collection;
use Cake\Controller\ComponentRegistry;
use YoHang88\LetterAvatar\LetterAvatar;
use DebugKit\View\Helper\CredentialsHelper;

/**
 * Zira component
 */
class ZiraComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function credential($credentials)
    {
        switch ($credentials->getStatus()) {
            case 'FAILURE_IDENTITY_NOT_FOUND':
                $m = "We couldn't find an account that matches what you entered";
                break;
            case 'FAILURE_CREDENTIALS_INVALID':
                $m = 'Email or Password is Invalid';
                break;
            case 'FAILURE_CREDENTIALS_MISSING':
                $m = "We couldn't find an account that matches what you entered";
                break;
            default:
                $m = 'something went wrong! invalid user';
        }
        return $m;
    }


    public function alphImage($name)
    {
        $avatar = new LetterAvatar($name);

        return $avatar->setColor('#' . substr(md5($name), 0, 6), '#ffffff');
    }

    public function getAvatar($profile)
    {
        $dir = new Folder('uploads' . DS . 'avatar' . DS);
        $file = null;
        if ($profile->avatar) {
            $file = $dir->find('.*\.' . pathinfo($profile->avatar, PATHINFO_EXTENSION));
        }
        return $file ? $profile->avatar : $this->alphImage($profile->full_name);
    }

    public function setAvatar($path, $file, $user = null)
    {

        if (!is_dir(WWW_ROOT . 'uploads')) :
            $dir = new Folder();
            $dir->create(WWW_ROOT . 'uploads');
        endif;
        $folder = new Folder(WWW_ROOT . 'uploads', true);
        if (!is_dir($folder->path . DS . $path)) :
            $folder->chmod($folder->path . DS . $path);
            Folder::addPathElement('uploads', $path);
            $folder->create($folder->path . DS . $path);
        endif;
        if (!is_null($user) && $user->profile->avatar) {
            $dir = new File('uploads' . DS . substr($user->profile->avatar, 7));
            $av = $dir->exists() ? $dir->path : '';
            unlink($av);
        }
        foreach ($file->getUploadedFiles() as $key => $value) {

            if (!$value->getError()) :
                $avtr = md5($value->getClientFilename() . rand()) . '.' . pathinfo($value->getClientFilename(), PATHINFO_EXTENSION);
                $value->moveTo('uploads' . DS . $path . DS . $avtr);
                return 'images' . DS . 'avatar' . DS . $avtr;
            endif;
        }
    }


    public function fileUploads($path, $req)
    {
        $now = FrozenTime::now();
        $current = $now->i18nFormat('dMMY');
        if (!is_dir(WWW_ROOT . 'uploads')) :
            $dir = new Folder();
            $dir->create(WWW_ROOT . 'uploads');
        endif;
        $folder = new Folder(WWW_ROOT . 'uploads', true);
        $DIR = DS . $path . DS . $current . DS;
        if (!is_dir($folder->path . DS . $path)) :
            $folder->chmod($folder->path . DS . $path);
            Folder::addPathElement('uploads', $path);
            $folder->create($folder->path . DS . $path);
        endif;
        foreach ($req->getUploadedFiles() as $key =>     $files) :
            if (is_array($files)) :
                foreach ($files as $file) {
                    $f = md5(rand() . $file->getClientFilename()) . '.' . pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);
                    $file->moveTo('uploads' . DS . $path . DS . $f);
                    $collections[] = $f;
                }
            else :
                $f = md5(rand() . $files->getClientFilename()) . '.' . pathinfo($files->getClientFilename(), PATHINFO_EXTENSION);
                $files->moveTo('uploads' . DS . $path . DS . $f);
                $collections = $f;
            endif;
            return $collections;
        endforeach;
    }
}
