package br.unp.poo;

public class Main {

    public static void main(String[] args) {
        Cachorro c1 = new Cachorro();
        Gato g1 = new Gato();
        Reproduzir r = new Reproduzir();
        System.out.println(r.emitir(c1));
        System.out.println(r.emitir(g1));
    }
}
