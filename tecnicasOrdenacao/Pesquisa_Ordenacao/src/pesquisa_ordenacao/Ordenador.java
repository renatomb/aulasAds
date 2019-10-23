package pesquisa_ordenacao;

/**
 *
 * @author nu4_lab201
 */
public class Ordenador {
    
    //campo do vetor da classe
    public int v[];    
    //construtor com o vetor em seu parâmetro
    public Ordenador(int[] v) {
        this.v = v;
    }
    
    //ordenação Bubble Sort
    public void bubbleSort(){
        for (int i = v.length; i >= 1; i--) {
            for (int j = 1; j < i; j++) {
                if (v[j-1] > v[j]){
                    int aux = v[j];
                    v[j] = v[j -1];
                    v[j - 1] = aux;
                }
            }
        }
    }
    
}
