<?php
class Login extends Model {
    public function validate(){
        $errors = [];
        if(!$this->email){
            $errors['email'] = 'E-mail é um campo obrigatório.';
        }
        if(!$this->password){
            $errors['password'] = 'Por favor, informe uma senha.';
        }
        if(count($errors) > 0){
            throw new ValidationException($errors);
        }
    }
    public function checkLogin(){
        $this->validate();
        $user = User::getOne(['email' => $this->email]);
        if($user){
            if($user->end_date){
                throw new AppException('Usuário desligado da empresa.');
            }
            //A função password_verify não aceita um objeto como segundo parâmetro. Ex: $user->password
            if(password_verify($this->password, $user->password)){
                return $user;
            }
        }
        throw new AppException('Usuário ou senha inválidos!');
    }
}