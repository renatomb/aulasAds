package myclass;

/**
 *
 * @author nu4_lab201
 */
public class Tree {
    
    private Node root;

    public Tree() {
    }

    public Tree(int valor) {
        Node folha = new Node(valor);
        this.root = folha;
    }

    public void addNode(int valor){
        Node folha = new Node(valor);
        
        if (isEmpty()){
            this.root = folha;
        }else{
            add(folha, root);
        }
    }
    
    public void add(Node folha, Node raiz){
        if (folha.getValor() < raiz.getValor()){
            if (raiz.getEsquerda() == null){
                raiz.setEsquerda(folha);
            }else{
                add(folha, raiz.getEsquerda());
            }
        }else{
            if (raiz.getDireita() == null){
                raiz.setDireita(folha);
            }else{
                add(folha, raiz.getDireita());
            }
        }
    }
            
            
    public boolean isEmpty(){
        return (root == null);
    }
    
    public void busca(int valor, Node folha){
        if (folha.getValor() == valor){
            System.out.println("Achei o valor");
        }else{
            if (valor < folha.getValor()){
                if (folha.getEsquerda() == null){
                    System.out.println("Nao Achei");
                }else{
                    busca(valor, folha.getEsquerda());
                }
            }else{
                if (folha.getDireita() == null){
                    System.out.println("Não achei");
                }else{
                    busca(valor, folha.getDireita());
                }
            }
        }
    }
    
    public void impEmOrdem(Node folha){
        if (folha != null){
            impEmOrdem(folha.getEsquerda());
            System.out.print(" "+folha.getValor());
            impEmOrdem(folha.getDireita());
        }
    }

    public void impPreOrdem(Node folha){
        if (folha != null){
            System.out.print(" "+folha.getValor());
            impPreOrdem(folha.getEsquerda());
            impPreOrdem(folha.getDireita());
        }
    }

    public void impPosOrdem(Node folha){
        if (folha != null){
            impPosOrdem(folha.getEsquerda());
            impPosOrdem(folha.getDireita());
            System.out.print(" "+folha.getValor());
        }
    }

    /**
     * @return the root
     */
    public Node getRoot() {
        return root;
    }

    /**
     * @param root the root to set
     */
    public void setRoot(Node root) {
        this.root = root;
    }
    
}
