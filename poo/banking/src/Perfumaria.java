public class Perfumaria {
    public static final String ANSI_RESET = "\u001B[0m";
    public static final String ANSI_BLACK = "\u001B[30m";
    public static final String ANSI_RED = "\u001B[31m";
    public static final String ANSI_GREEN = "\u001B[32m";
    public static final String ANSI_YELLOW = "\u001B[33m";
    public static final String ANSI_BLUE = "\u001B[34m";
    public static final String ANSI_PURPLE = "\u001B[35m";
    public static final String ANSI_CYAN = "\u001B[36m";
    public static final String ANSI_WHITE = "\u001B[37m";
    void cabeca() {
        System.out.println(this.ANSI_GREEN+"****************************************************************\n"+
                "*** Bem vindo a cooperativa de Credito dos Hackers do Brasil ***\n"+
                "****************************************************************"+this.ANSI_RESET);
    }
    void menu() {
        System.out.println("***              M E N U      P R I N C I P A L              ***\n" +
                "****************************************************************\n" +
                "***    "+this.tc("1",34)+" - Deposito em conta                                 ***\n" +
                "***    "+this.tc("2",34)+" - Saque da conta                                    ***\n" +
                "***    "+this.tc("3",34)+" - Saldo da conta                                    ***\n" +
                "***    "+this.tc("4",34)+" - Transferencia entre contas                        ***\n" +
                "***    "+this.tc("0",34)+" - Sair do sistema                                   ***\n" +
                "****************************************************************\n");
    }
    String tc(String texto, int cor){
        String retorno="";
        return "\u001B["+cor+"m"+texto+"\u001B[0m";
    }
}
