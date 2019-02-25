import java.util.Scanner;
import java.io.IOException;

public class Main {

    public static void main(String[] args) {
        BankAccount[] contasArray = new BankAccount[10];
        for ( int i=0; i<contasArray.length; i++) {
            contasArray[i]=new BankAccount();
        }
        Perfumaria rnt = new Perfumaria();
        Scanner teclado = new Scanner(System.in);
        contasArray[0].titular="Renato Monteiro Batista";
        contasArray[0].saldo=250000.00;
        int operacao = 9;
        double valor;
        while(operacao > 0){
            rnt.cabeca();
            rnt.menu();
            operacao = teclado.nextInt();
            switch(operacao){
                case 2:

                    System.out.println("Quanto deseja sacar?");
                    valor = teclado.nextFloat();
                    contasArray[0].sacar(valor);
                    break;
                case 1:
                    System.out.println("Quanto deseja depositar?");
                    valor = teclado.nextFloat();
                    contasArray[0].depositar(valor);
                    break;
                case 3:
                    contasArray[0].showTitular();
                    contasArray[0].saldo();
                    break;
                case 0:
                    break;
                default: System.out.println("!!! Opcao invalida !!!");
                    break;
            }
        }
        System.out.println("Sessao encerrada.");
    }
}