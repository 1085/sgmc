<?php

require_once '../models/ModelConexao.class.php';


class ControllerPrincipal {

    public function __construct() {
        $_SESSION['login_error'] = "";
    }

    public function validarLogin() {
        if (isset($_POST['login'])) {
            $login = $_POST['login'];
        }

        if (isset($_POST['password'])) {
            $password = $_POST['password'];
            $password = md5('2013webES' . $password);
        }

//utiliza uma função para validar os dados digitados
        $result = ModelConexao::executarFiltro("p.idpessoa", "pessoa p", "(p.login = '$login') and (p.senha = '$password')");
        if (ModelConexao::totalRegistroFiltrados() == 1) {
            $row = $result->fetch_object();
            $_SESSION['idpessoa_logado'] = $row->idpessoa;

//registra usuário
            $_SESSION['login'] = $login;
//registra data login
            $_SESSION['data_login'] = date("M d y H:i:s");
//limpa mensagem de erro ao logar
            $_SESSION['login_error'] = "";
//manda para página inicial da rede
            header("Location: ../view/principal.php");
        } else {
            $_SESSION['idpessoa_logado'] = "";
//registra mensagem de erro ao logar
            $_SESSION['login_error'] = "~~> Login ou senha incorretos <~~";
//o usuário e/ou a senha são inválidos, manda para página de erro
            header("Location: ../view/login.php");
        }
    }
?>