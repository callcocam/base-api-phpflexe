<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 01/11/2018
 * Time: 10:41
 */

namespace App\Admin\Model;


use Firebase\JWT\JWT;
use Flexe\FlashMessenger;
use Flexe\Model\Db;
use Flexe\Tuupola\Base62;

class AuthModel extends Db
{
    protected $table = "users";

    protected $fillable = ['company_id','role_id','name','email','cover','password','description','status','created_at_at','updated_at'];

    protected $hidden = [];

    protected  $casts = [
        'created_at'=>'timestamp','updated_at'=>'timestamp'
    ];

    const FAILURE = 0;
    const FAILURE_IDENTITY_NOT_FOUND = 1;
    const FAILURE_IDENTITY_AMBIGUOUS = 2;
    const FAILURE_CREDENTIAL_INVALID = 3;
    const FAILURE_UNAUTHORIZED = 4;
    const SUCCESS = 5;

    protected $Result = [];

    protected $Code;

    protected $Type = "error";

    public function authenticate($login,$password){

        $this->Result = $this->where([
            'email'=>$login
        ])->first();

        $this->Code = self::FAILURE_CREDENTIAL_INVALID;

        if($this->Result):

            if(!password_verify(sprintf("%s-%s", $password, $login), $this->Result['password'])):

                $this->Code = self::FAILURE_IDENTITY_NOT_FOUND;

                unset($this->Result['password']);

            else:

                if(!$this->Result['status']):

                    $this->Code = self::FAILURE_IDENTITY_AMBIGUOUS;

                else:

                    $this->Code = self::SUCCESS;

                endif;

            endif;

        endif;

        return $this->Code;

    }

    public function getResult(){

        switch ($this->Code) {

            case self::FAILURE_IDENTITY_NOT_FOUND:
                $this->Type = FlashMessenger::NAMESPACE_WARNING;
                /** do stuff for nonexistent identity **/
                return "Sua identidade não foi encontrada, inexistente";
                break;

            case self::FAILURE_CREDENTIAL_INVALID:
                $this->Type = FlashMessenger::NAMESPACE_INFO;
                /** do stuff for invalid credential **/
                return "Credenciais inválidas, não foi encontrada, inexistente";
                break;

            case self::SUCCESS:
                $this->Type = FlashMessenger::NAMESPACE_SUCCESS;
                /** do stuff for successful authentication **/
                return "Autenticação bem-sucedida, credenciais verificadas com sucesso!";
                break;

            default:
                $this->Type = FlashMessenger::NAMESPACE_ERROR;
                /** do stuff for other failure **/
                return "Autenticação falhou, se você ja e cadastrado tente mais tarde";
                break;
        }


    }

    public function getCode(){

        return $this->Code;

    }
    public function createAdminUserIfNotExists($company)
    {
        $Result = $this->where( [
            'company_id'=>$company['id']
        ])->first();

        if (!$Result) {
            $user['company_id'] = $company['id'];
            $user['email'] = sprintf('admin@%s.com', COMPANY_KEY);
            $user['name'] = sprintf("Dr: %s", COMPANY_KEY);
            $user['role_id']        = $this->createRoleNotExists($company);
            $user['status'] = '1';
            $passwordHash =         $this->generate_hash(sprintf("%s-%s", 'Security',$user['email']));
            $user['password']       = $passwordHash;
            $user['updated_at']     = date('Y-m-d H:i:s');
            $userAdminId =  self::query()->insert($user);;
            return $userAdminId;
        }


    }
    /*
            * Generate a secure hash for a given password. The cost is passed
            * to the blowfish algorithm. Check the PHP manual page for crypt to
            * find more information about this setting.
            */
    public function generate_hash($password, $cost=11){
        return password_hash($password, PASSWORD_DEFAULT, [
            'cost' => $cost
        ]);
    }
    private function createRoleNotExists($company){


        $Result = RoleModel::query()->where( [
            'company_id'=>$company
        ])->orderBy("id","DESC")->get()->toArray();

        if (!$Result) {

            $cliente = [
                'company_id'=>$company['id'],
                'name'=> 'Cliente',
                'alias'=> 'cliente',
                'status'=>'1',
                'is_admin'=>'0',
                'description'=>'Usuário da parte front-end e que usa o site para adiquirir produtos ou serviços - '.$Companys['name'],
                'updated_at'=> \Carbon\Carbon::create()
            ];

            $ResultId = RoleModel::query()->insertGetId($cliente);

            $assinante = [
                'company_id'=>$company['id'],
                'role_id'=>$ResultId,
                'name'=> 'Assinante',
                'alias'=> 'assinante',
                'status'=>'1',
                'is_admin'=>'0',
                'description'=>"Usuário da parte front-end do sistema, e que pode ter acesso a novos conteudo sem ter que fazer um nova contratação- ".$Companys['name'],
                'updated_at'=> \Carbon\Carbon::create()
            ];

            $ResultId = RoleModel::query()->insertGetId($assinante);

            $usuario_admin = [
                'company_id'=>$company['id'],
                'role_id'=>$ResultId,
                'name'=> 'Usuário Admin',
                'alias'=> 'usuario-admin',
                'is_admin'=>'0',
                'description'=>"Secretárias, Vendedores e etc... - ".$Companys['name'],
                'updated_at'=> \Carbon\Carbon::create()
            ];

            $ResultId = RoleModel::query()->insertGetId($usuario_admin);

            $colaborador = [
                'company_id'=>$company['id'],
                'role_id'=>$ResultId,
                'name'=> 'Colaborador',
                'alias'=> 'colaborador',
                'status'=>'1',
                'is_admin'=>'0',
                'description'=>"Colobora com o gerente geral mas não tem todas a permissões dele - ".$Companys['name'],
                'updated_at'=> \Carbon\Carbon::create()
            ];

            $ResultId = RoleModel::query()->insertGetId($colaborador);

            $gerente_geral = [
                'company_id'=>$company['id'],
                'role_id'=>$ResultId,
                'name'=> 'Gerente Geral',
                'alias'=>'gerente-geral',
                'status'=>'1',
                'is_admin'=>'0',
                'description'=>"Gerencia o sistema correspondente - ".$Companys['name'],
                'updated_at'=> \Carbon\Carbon::create()
            ];

            $ResultId = RoleModel::query()->insertGetId($gerente_geral);

            $administrador = [
                'company_id'=>$company['id'],
                'role_id'=>$ResultId,
                'name'=> 'Administrador',
                'alias'=>'administrador',
                'is_admin'=>'0',
                'description'=>"Administra todo o sistema correspondente a ele - ".$Companys['name'],
                'updated_at'=> \Carbon\Carbon::create()
            ];

            $ResultId = RoleModel::query()->insertGetId($administrador);

            $suporte_geral = [
                'company_id'=>$company['id'],
                'role_id'=>$ResultId,
                'name'=> 'Suporte Geral',
                'alias'=> 'suporte-geral',
                'status'=>'1',
                'is_admin'=>'1',
                'description'=>"Auxilia o uso do sistema para colaboradores e funcionarios de toda a rede",
                'updated_at'=> \Carbon\Carbon::create()
            ];

            $ResultId = RoleModel::query()->insertGetId($suporte_geral);

            $super_admin = [
                'company_id'=>$company['id'],
                'role_id'=>$ResultId,
                'name'=> 'Super Admin',
                'alias'=>'super-admin',
                'status'=>'1',
                'is_admin'=>'1',
                'description'=>"Adminintrador geral de todos os sistemas",
                'updated_at'=> \Carbon\Carbon::create()
            ];

            $ResultId = RoleModel::query()->insertGetId($super_admin);

            return $ResultId;
        }
        return $Result['id'];
    }
    public function getToken($secret){

        if($this->Code===5):

            $now = new \DateTime();

            $future = new \DateTime("+60 minutes");

            $jti = (new Base62())->encode(random_bytes(16));

            $payload = [

                "iat" => $now->getTimeStamp(),

                "exp" => $future->getTimeStamp(),

                "jti" => $jti

            ];
            $token = JWT::encode($payload, $secret, "HS256");

            $data["token"] = $token;

            $data["expires"] = $future->getTimeStamp();

            $data['user']=$this->Result;

            return $data;

        endif;

        return [];

    }

}