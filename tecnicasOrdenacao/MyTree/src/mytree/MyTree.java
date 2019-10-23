package mytree;

import myclass.Tree;

/**
 *
 * @author nu4_lab201
 */
public class MyTree {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        Tree arvore = new Tree(50);
        arvore.addNode(60);
        arvore.addNode(70);
        arvore.addNode(40);
        arvore.addNode(30);
        arvore.addNode(20);
        arvore.addNode(25);
        arvore.addNode(15);
        arvore.addNode(10);
        
        arvore.impEmOrdem(arvore.getRoot());
        System.out.println("");
        arvore.impPreOrdem(arvore.getRoot());
        System.out.println("");
        arvore.impPosOrdem(arvore.getRoot());
        System.out.println("");
        
        System.out.println("Procurando o elemento 100");
        arvore.busca(100, arvore.getRoot());
        System.out.println("Procurando o elemento 10");
        arvore.busca(10, arvore.getRoot());
        
        if (arvore.isEmpty()){
            System.out.println("Arvore Vazia");
        }
        
    }
    
}
