/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package br.unp.aplicacao;
import br.unp.classes.Aluno;
import br.unp.classes.Vetor;
/**
 *
 * @author rmb
 */
public class Aplicacao {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        Aluno a1 = new Aluno();
        Aluno a2 = new Aluno();
        Aluno a3 = new Aluno();
        a1.setNome("Rafael");
        a2.setNome("Paulo");
        a3.setNome("Xavier");
        Vetor lista = new Vetor();
//        lista.adiciona(a1);
//        lista.adiciona(a2);
//        lista.adiciona(a3);
        System.out.println(lista.toString());
    }
    
}
