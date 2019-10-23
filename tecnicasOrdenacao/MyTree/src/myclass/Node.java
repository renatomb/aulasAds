package myclass;

/**
 *
 * @author nu4_lab201
 */
public class Node {
    private int valor;
    private Node esquerda;
    private Node direita;

    public Node() {
    }

    public Node(int valor, Node esquerda, Node direita) {
        this.valor = valor;
        this.esquerda = esquerda;
        this.direita = direita;
    }
    
    public Node(int valor) {
        this.valor = valor;
    }

    
    
    /**
     * @return the valor
     */
    public int getValor() {
        return valor;
    }

    /**
     * @param valor the valor to set
     */
    public void setValor(int valor) {
        this.valor = valor;
    }

    /**
     * @return the esquerda
     */
    public Node getEsquerda() {
        return esquerda;
    }

    /**
     * @param esquerda the esquerda to set
     */
    public void setEsquerda(Node esquerda) {
        this.esquerda = esquerda;
    }

    /**
     * @return the direita
     */
    public Node getDireita() {
        return direita;
    }

    /**
     * @param direita the direita to set
     */
    public void setDireita(Node direita) {
        this.direita = direita;
    }
}
