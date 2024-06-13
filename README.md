<h1 align="center" style="font-weight: bold;">🏃‍♂️ In 'N Out 💼</h1>

https://github.com/matheusaguiarrr/InNout/assets/106553412/d0e1a842-e509-4f08-a8d6-6ddb16478388

<div align="center"> 
  <a href="https://developer.mozilla.org/pt-BR/docs/Web/HTML"><img src="https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white" target="_blank"></a>
  <a href="https://developer.mozilla.org/pt-BR/docs/Web/CSS"><img src="https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white" target="_blank"></a>
  <a href="https://developer.mozilla.org/pt-BR/docs/Web/JavaScript"><img src="https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E" target="_blank"></a>
  <a href="https://getbootstrap.com/"><img src="https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white" target="_blank"></a>
  <a href="https://www.php.net/"><img src="https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white" target="_blank"></a>
  <a href="https://www.mysql.com/"><img src="https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white" target="_blank"></a>
  <a href="https://www.udemy.com/pt/"><img src="https://img.shields.io/badge/apache-%23D42029.svg?style=for-the-badge&logo=apache&logoColor=white" target="_blank"></a> 
  <a href="https://www.udemy.com/pt/"><img src="https://img.shields.io/badge/Udemy-A435F0?style=for-the-badge&logo=Udemy&logoColor=white" target="_blank"></a>
</div>

<br>
<p align="center">
  • <a href="#executando">Executando na sua máquina</a> •
  <a href="#pastas">Estrutura das Pastas</a> •
  <a href="#licenca">Licença</a> •
</p>

<p align="center">
  <b>Projeto desenvolvido ao final do curso de PHP 7 Completo da Cod3r na plataforma Udemy. In 'N Out é um sistem de ponto eletrônico.</b>
</p>
<br>
<h2 id="executando">🚀 Executando o projeto na sua máquina local</h2>

<h3>Pré-Requisitos</h3>

- [PHP 8](https://github.com)
- [Servidor Apache](https://www.apachefriends.org/pt_br/download.html)
- [MySQL](https://dev.mysql.com/downloads/installer/)

<h3>Clonando o projeto</h3>

Como clonar o projeto

```bash
git clone https://github.com/matheusaguiarrr/InNout.git
```

<h3>Criando e Conectando o Banco de Dados</h3>

- Crie um banco chamado INNOUT
- Execute o arquivo sql contido na pasta extras
- Dentro da pasta src, preencha o arquivo env.sample.ini com as seguintes informações
 
![image](https://github.com/matheusaguiarrr/InNout/assets/106553412/0299438c-f572-4b51-9605-945cc6c0f299)

- Mude o nome do arquivo para env.ini

<h3>Configurando o servidor Apache</h3>

- Clique no botão "Config" ao lado do Apache no painel de controle.
- Escolha a opção httpd.conf para abrir o arquivo de configuração principal do Apache.
- Localize a diretiva DocumentRoot
```bash
DocumentRoot "C:/xampp/htdocs"
```
- Logo abaixo desta linha, você verá outra linha semelhante:
```bash
<Directory "C:/xampp/htdocs">
```
- Alterare o DocumentRoot e Directory
- Substitua "C:/xampp/htdocs" pelo caminho para a sua pasta do projeto.
```bash
DocumentRoot "C:/meu_projeto"
```

```bash
<Directory "C:/meu_projeto">
```
<br>
<h2 id="pastas">🗂️ Estrutura das Pastas</h2>

```
extras/
public/
├── assets/
│   ├── css/
│   ├── js/
src/
├── config/
├── controllers/
├── exceptions/
├── models/
├── views/
│   └── template
```
<br>
<h2 id="licenca">📝 Licença</h2>

Este projeto está sob a licença [MIT](LICENSE) license
