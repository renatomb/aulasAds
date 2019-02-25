/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package br.unp.classes;

import java.util.Objects;

/**
 *
 * @author rmb
 */
public class Aluno {

    private String nome;

    /**
     * @return the nome
     */
    public String getNome() {
        return nome;
    }

    /**
     * @param nome the nome to set
     */
    public void setNome(String nome) {
        this.nome = nome;
    }
    
    @Override
    public String toString(){
        return getNome();
    }
    
    @Override
    public boolean equals(Object o) {
        Aluno outro = (Aluno)o;
        return this.nome.equals(outro.nome);
    }


}
