<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuarioSistema
 *
 * @author jefferson
 */
class UsuarioSistema {
    private $idUsuario;
    private $idPFisica;
    private $login;
    private $senha;
    public $horaInicial;
    public $horaFinal;
    public $observacoes;
    
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdPFisica() {
        return $this->idPFisica;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getHoraInicial() {
        return $this->horaInicial;
    }

    function getHoraFinal() {
        return $this->horaFinal;
    }

    function getObservacoes() {
        return $this->observacoes;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setIdPFisica($idPFisica) {
        $this->idPFisica = $idPFisica;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setHoraInicial($horaInicial) {
        $this->horaInicial = $horaInicial;
    }

    function setHoraFinal($horaFinal) {
        $this->horaFinal = $horaFinal;
    }

    function setObservacoes($observacoes) {
        $this->observacoes = $observacoes;
    }


}
