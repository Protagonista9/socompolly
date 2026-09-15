<?php
class Usuario {
   public string $nome;   //quando publico, todos fazem acesso a essa propriedade
   public string $email;    // quando privado, apenas a própria classe pode acessar a propriedade
   public string $senha;  //quando protected, apenas a própria classe e as classes filhas podem acessar a propriedade    

   public function __construct(string $nome, string $email, string $senha) {       
       $this->nome = $nome;
       $this->email = $email;
       $this->senha = $senha;   
   }

   
   
   // existe um padrao de desing chamado singleton, 
   //que é um padrão de projeto que garante que uma classe 
   //tenha apenas uma instância e fornece um ponto global de acesso a essa instância.

   // Setters
   public function setNome(string $nome): void {
       $this->nome = $nome;
   }  

   public function getNome(): string {
       return $this->nome; // Corrigido aqui
   }    

   public function setEmail(string $email): void {
       $this->email = $email;
   }   

   public function getEmail(): string {
       return $this->email; // Corrigido aqui
   }   

   public function setSenha(string $senha): void {
       $this->senha = $senha;
   }   

   public function getSenha(): string {
       return $this->senha; // Corrigido aqui
   }             
}

