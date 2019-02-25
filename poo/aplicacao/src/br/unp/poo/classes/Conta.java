package br.unp.poo.classes;

public class Conta {
    public int numero;
    public String titular;
    public double saldo;



    public void depositar( double quantidade){
        this.saldo +=quantidade;
    }
    public boolean sacar(double valor){
        if(this.saldo < valor){
            return false;
        }
        else{
            this.saldo -= valor;
            return true;
        }
    }
}
