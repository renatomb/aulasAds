public class BankAccount {
    String titular;
    double saldo;
    boolean sacar(double quantidade){
        if(saldo < quantidade){
            return false;
        }
        else{
            this.saldo -=quantidade;
            return true;
        }
    }
    void depositar(double quantidade){
        this.saldo += quantidade;
    }
    void saldo(){
        System.out.println( "nome: "+this.titular+"\nsaldo:"+this.saldo+"\n");
    }
    void showTitular() {
        System.out.println("Titular: "+this.titular+"\n");
    }
}
