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
    private int totalDeAlunos = 0;

    public void adiciona(Aluno aluno) {
        this.alunos[this.totalDeAlunos] = aluno;
        this.totalDeAlunos++;
    }

    public int tamanho(){
        return this.totalDeAlunos;
    }

    public boolean contem(Aluno aluno) {
        for (int i = 0; i < this.totalDeAlunos; i++) {
            if (aluno.equals(this.alunos[i])) {
                return true;
            }
        }
        return false;
    }

    private boolean posicaoOcupada (int posicao){
        return posicao >= 0 && posicao < this.totalDeAlunos;
    }

    @Override
    public String toString(){
        if (this.totalDeAlunos == 0) {
            return "[ ]";
        }
        StringBuilder builder = new StringBuilder(); // Classe que permite manipular String's dinamicamente
        builder.append("[");
        for (int i=0; i < this.totalDeAlunos -1; i++) {
            builder.append(this.alunos[i]); // Concatenando String's dinamicamente
            builder.append(", ");
        }
        builder.append(this.alunos[this.totalDeAlunos -1]);
        builder.append("]");
        return builder.toString();
        //return Arrays.toString(alunos);
    }

}
