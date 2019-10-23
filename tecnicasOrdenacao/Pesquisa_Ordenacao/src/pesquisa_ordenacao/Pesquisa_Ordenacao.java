package pesquisa_ordenacao;

import javax.swing.JOptionPane;

public class Pesquisa_Ordenacao {

    public static void main(String[] args) {
        // define a qtd de elementos do vetor
        int qtdelementos = 10000;
        // criar o vetor com o tamanho desejado
        int v[] = new int[qtdelementos];
        //preencher o vetor com uma valor randomizado
        //entre 0 e a qtdelementos
        for (int i = 0; i < v.length; i++) {
            //colocar o novo valor na posicao i do vetor
            v[i] = (int) (Math.random() * qtdelementos);
        }

        //criar o objeto Buscador
        Buscador b = new Buscador(v);

        //procurar um número
        String valor = JOptionPane.showInputDialog("Digite um número");
        int retorno = b.buscaSeq(Integer.parseInt(valor));
        if (retorno == -1) {
            JOptionPane.showMessageDialog(null, "Elemento não encontrado");
        } else {
            JOptionPane.showMessageDialog(null, "Elemento encontrado na posição " + String.valueOf(retorno) + " do vetor");
        }

        //medir o tempo inicial
        long tinicio = System.currentTimeMillis();
        //criar o objeto ordenador
        Ordenador o = new Ordenador(v);
        o.bubbleSort();

        //medir o tempo final
        long tfinal = System.currentTimeMillis();
        //colocar a diferença dos tempos
        System.out.println("Ordenou em " + (tfinal - tinicio) + " ms");

        retorno = b.buscaBinaria(Integer.parseInt(valor), 0, v.length-1);
        if (retorno == -1) {
            JOptionPane.showMessageDialog(null, "Elemento não encontrado");
        } else {
            JOptionPane.showMessageDialog(null, "Elemento encontrado na posição " + String.valueOf(retorno) + " do vetor");
        }
    }

}
