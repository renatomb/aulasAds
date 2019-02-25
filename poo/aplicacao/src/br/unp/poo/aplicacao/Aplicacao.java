package br.unp.poo.aplicacao;
import br.unp.poo.classes.Conta;

public class Aplicacao {

    public static void main(String[] args) {
        Conta c1 = new Conta();
        c1.numero = 0001;
        c1.titular = "Pedor";
        c1.saldo = 10.01;
        System.out.println("O numero da conta eh"+c1.numero);
        System.out.println("O Titular eh"+c1.titular);
        System.out.println("O saldo da conta >"+c1.titular);
    }
}
