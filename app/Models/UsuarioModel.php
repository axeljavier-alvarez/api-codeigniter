<?php
namespace App\Models;
use CodeIgniter\Model;


class UsuarioModel extends Model
{
    protected $table = 'usuario';

    protected $primaryKey = 'idUsuario';
    protected $allowedFields = [
        'nombre',
        'apellido',
        'correoElectronico',
        'password',
        'estado'
    ];


    protected $validationRules = [
        'nombre' => 'required',
        'apellido' => 'required',
        'correoElectronico' => 'required|valid_email',
       /*  'password' => 'required|valid_password', */
       /*  'estado' => 'required' */
    ];

}

