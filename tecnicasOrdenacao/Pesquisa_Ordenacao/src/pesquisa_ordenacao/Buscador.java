package pesquisa_ordenacao;

public class Buscador {

    //campo do vetor da classe
    public int v[];

    //construtor que receberá o vetor como parametro
    public Buscador(int[] v) {
        this.v = v;
    }

    //criar o metodo para fazer a busca sequencial
    public int buscaSeq(int chave) {
        //inicia a busca sequencial
        return buscaSeqRecursivo(v.length, chave);
    }

    //busca sequencial com recursividade
    public int buscaSeqRecursivo(int tamanho, int chave) {
        //se tamanho zerado é pq não achou
        if (tamanho == 0) {
            return -1;
        }
        //se a posição final é igual a chave é pq achou
        //então retrna a posição
        if (v[tamanho - 1] == chave) {
            return (tamanho - 1);
        } else {
            //caso contrário chama a rotina 
            //com um tamanho a menos
            return buscaSeqRecursivo(tamanho - 1, chave);
        }
    }

    //busca binária
    public int buscaBinaria(int chave, int inicio, int fim) {
        if (inicio > fim) {
            return -1;
        }
        int meio = (inicio + fim) / 2;

        if (v[meio] == chave) {
            return meio;
        }

        if (chave < v[meio]) {
           return buscaBinaria(chave, inicio, meio - 1);
        } else {
           return buscaBinaria(chave, meio + 1, fim);
        }
    }
}
