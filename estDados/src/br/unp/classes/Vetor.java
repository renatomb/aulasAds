/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package br.unp.classes;
import java.util.Arrays;
/**
 *
 * @author rmb
 */
public class Vetor {
    private Aluno[] alunos = new Aluno[100];
    
    @Override
    public String toString(){
        return Arrays.toString(alunos);
    }
    
}
