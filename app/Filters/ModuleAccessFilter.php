<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ModuleAccessFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session()->has('loggedUser'))
        {
          return redirect()
            ->to('/dashboard')
            ->with('fail', 'Du hast keinen Zugriff auf dieses Modul. Bitte wende dich an den Admin!');
        }

        $userid = session()->get('loggedUser');

        $uri = $request->getUri();

        $user_model = new \App\Models\UserModel();
        $module_model = new \App\Models\ModuleModel();
        $module_user_model = new \App\Models\ModuleUserModel();

        $userinfo = $user_model->where('id', $userid)->first();

        if (!$userinfo)
        {
          return redirect()->to('/auth')->with('fail', 'Benutzer nicht gefunden');
        }

        $path = explode("/", $uri->getPath() );

        $module = $module_model->where('module_path', $path[0] )->first();

        if (! $module )
        {
          return
            redirect()
              ->to('/dashboard')
              ->with('fail', 'Kein passendes Modul gefunden: ' . $path[0]);
        }

        $assignment = $module_user_model->where([
          'user' => $userinfo->id,
          'module' => $module->id
        ])->first();

        if (! $assignment)
        {
          return redirect()
            ->to('/dashboard')
            ->with('fail', 'Du bist nicht authorisiert dieses Modul zu verwenden!');
        }

        /*
        return redirect()
          ->to('/dashboard')
          ->with('success', 'Hat funktioniert: ' . $uri->getPath());
          */
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
