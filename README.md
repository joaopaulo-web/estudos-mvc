## Estudos MVC

Repositório destinado para armazenamento dos estudos relacionados a estrutura MVC

## Anotações

MVC

O que é MVC? 

Por definição, o MVC é um padrão arquitetural que divide os elementos da aplicação em três camadas.

Quando desenvolvemos um sistema ele possui várias classes internas e vários componentes que em conjunto desempenham várias funções, como por exemplo, exibição de dados, conexão com um banco de dados, tratamento dos dados, modelagem, validações, etc. O padrão MVC entra neste contexto, para propor uma divisão desses elementos segundo a sua responsabilidade dentro do sistema.

Seguindo esse pensamento, iremos dividir em três camadas: 

Model - Gerencia as regras de negócios, manipula dados, gerencia as configurações com o banco de dados e tudo aquilo que está relacionado com a obtenção ou persistência de dados; Cabe ao model, modelar as entidades do sistema, e lidar com os dados da aplicação. É no model, que iremos estabelecer e conectar uma fonte de dados, receber esses dados, tratar os dados, validar os dados, etc.
View - É a parte externa do projeto, aquilo que o usuário vai ver. Um exemplo básico seria uma página HTML, ou seja, aquele retorno HTML. Na view, é onde teremos a interface de comunicação com o usuário, seja uma página HTML estilizada com CSS e com scripts JavaScript, ou um formulário, um gráfico, tabela. Nesta camada, irá ocorrer a interação com o usuário final do sistema. Ou seja, os dados obtidos pelo model, irão ser apresentados pro usuário na camada de view.
Controller - Responsável por fazer uma ponte entre os dados obtidos no model, e a exibição desses dados na View. É por meio dele que as requisições são processadas e cada ação é executada dentro da model. Qualquer ação, seja ela de exclusão, adição, etc, é o controller que irá disparar. Responsável por intermediar a comunicação e dinâmica entre o model e o view. Ele é o responsável por receber as requisições do usuário, tratá-las e respondê-las adequadamente. Para que isso aconteça, ele irá requerer ao model os dados necessários, e irá entregar esses dados na view. Da mesma forma quando um usuário enviar dados para a aplicação, como por exemplo, por envio de um formulário, essa view irá repassar os dados para o controller que irá tratar esses dados e de acordo com o seu objetivo, repassar para o model para que seja persistidos na base de dados.

Na prática, funcionaria mais ou menos assim:

Quando o usuário acessa a aplicação usando o URL, o que ele irá visualizar ali, é a view, um conjunto de elementos, html, imagens e inputs, que tem como objetivo interagir com o usuário de forma amigável. Essa view por sua vez, para exibir os dados que o usuário precisa, irá solicitar do controller que isso lhe seja repassado, sendo assim, o controller irá tratar a requisição do usuário, irá buscar no model os dados que ele precisa, em seguida, o model irá retornar essas informações da base de dados ou de uma fonte externa, e o controller, uma vez que tratado esses dados, irá exibir para o usuário, através da camada view. Na view, esses dados poderão ser exibidos de diversas formas, tabela, formulário, gráficos. 

Então, com essa divisão, fica bem claro a responsabilidade de cada elemento do sistema e facilita a manutenção posterior. Por exemplo, se o layout da aplicação mudar, seja por questões de cores, dimensões, formas, eu não precisarei alterar o controller ou o model, bastará apenas que eu altere a view, para atender os novos requisitos. Da mesma forma se por algum motivo um requisito surgir dizendo que o meu controller passe a responder um usuário de uma forma diferente, por exemplo, quando um usuário requisitar uma lista de produtos, o meu controller pode listar todos os produtos, ou apenas os últimos cadastrados de acordo com a lógica da aplicação eu farei essa alteração apenas no controller. Da mesma forma, se surgirem modificações nos dados, na representação dos dados da minha aplicação, eu precisarei trabalhar na camada de model, separando assim as responsabilidades de cada elemento.

Por onde começar?

É preciso ter PHP instalado na máquina juntamente com o Composer:

O primeiro arquivo a ser criado, deve ser o composer.json. Ele será o responsável por gerenciar as dependências do projeto.
Defina o nome do seu projeto, juntamente com algumas instruções, como o autoload*, psr-4* e por fim definir o namespace padrão. No nosso caso, será App, e uma pasta que irá referenciar um namespace. Usaremos app. No final, teremos este arquivo:

{
    "name":"joao/mvc",
    "autoload":{
        "psr-4": {
            "App\\":"app/" 
        }
    }
}

* Os arquivos consequentemente precisam ser incluídos para que o código dentro dele possa ser usado. Com esse intuito usamos o que chamamos em PHP de autoloading, que basicamente é uma lógica para carregar nossos arquivos automaticamente. A PSR-4 vai de encontro ao desenvolvimento moderno de aplicações PHP e possui tudo que o desenvolvedor precisa para trabalhar com orientação a objetos. Ela foi pensada para funcionar com namespace e facilitar que o projeto atenda outras recomendações

O que é uma PSR?

Uma PSR basicamente possui recomendações sobre um tema específico, como por exemplo, a PSR-12 que fala sobre padronização de sintaxe de código.


Após escrever o composer.json, o próximo passo é instalar todas essas dependências.
Abrimos um terminal, e executamos o comando composer install
Após a execução deste comando, irá ser criado uma pasta chamada vendor, e dentro desta pasta, um arquivo chamado autoload.php

Cria-se em seguida dentro da pasta de trabalho, um index.php apenas para vermos as respostas e incluímos o autoload.php que foi gerado anteriormente:


__DIR__ - Referenciamos um diretório dentro do arquivo index.php. 
Quando usamos o __ DIR__ dentro de um arquivo, ele nos retorna o diretório do arquivo referenciado.

‘/vendor/autoload.php’ - Local onde o arquivo autoload está localizado.


Controller

O próximo passo é começarmos a dividir nossa aplicação. 
Primeiro, começamos com a criação da pasta app, pois foi esse o nome que definimos no composer.json;
Dentro da pasta app, criamos a primeira pasta de separação, a pasta Controller. Esta página vai ser a responsável por guardar os controladores. Devemos começar com os controladores pois ele é a ponte entre a View e o Model, ou seja entre o que o usuário vai ver e o que a gente irá retornar de dados para ele;
Dentro da pasta Controller, iremos criar mais uma pasta chamada Pages, onde dentro dela, criaremos o primeiro controlador: home.php (esse controlador é uma classe);
O controller deve ser responsavel por pegar os dados que o model retornou e coloca-los dentro da view para serem retornados, mas, não deve ser retornado o conteúdo realmente, por isso, precisamos da view

View.php

Cria-se na raiz do projeto uma pasta chamada resources. Ela sera responsavel por guardar os arquivos HTML, CSS, JS, imagens, etc;
Dentro da pasta resources, cria-se uma outra pasta chamada view
Dentro da pasta view, cria-se outra pasta chamada pages
Dentro dela, cria-se um arquivo chamado home.html

Utils

Para fazermos a função getHome (função contida em Home, que está dentro de Pages e dentro da pasta Controller) retornar, iremos criar uma classe pra gerenciar o acesso às views.

Para isso, cria-se uma nova pasta dentro de app, de nome Utils.

Dentro de Utils, vou criar um novo arquivo chamado View.php, essa classe irá gerenciar as views.

Nessa classe, iremos criar alguns métodos, que vão ser responsáveis por renderizar as nossas views (arquivos html contidos em resources\view\pages), principalmente quando tivermos um conteúdo dinâmico, como o nome de um usuário que está conectado, ou algum dado que é referente ao banco de dados. 

Primeiro passo é criar um método chamado render, esse método irá ser responsável por renderizar as views. Esse método, irá receber um parâmetro, que é o nome da view que vai ser executado;
 Quando o parâmetro for passado, a função render irá procurar na pasta de resources se a view existe, caso ela exista, irá retornar o conteúdo, se não existir, vai ser retornado vazio.
Para fazer essa validação, cria-se um outro método, desta vez privado, de nome getContentView.
Esse método irá receber como parâmetro, o nome da view. Esta função, irá receber o nome EXATO que está contido na view;
Dentro do método getContentView, iremos criar uma variável de nome $file que irá receber __DIR__.’/../../resources/view/’.$view.’.html’;
A ideia é: iremos chamar a view, neste caso home.html, com pages/home, ou pages/sobre, pages/produto
Em seguida iremos retornar com uma verificação usando file_exists($file) ? file_get_contents($file) : ‘’; Basicamente estou dizendo que, se esse arquivo existir (pages/home, ou pages/sobre, pages/produto), ele irá retornar para a gente, caso ele não exista, irá retornar vazio;
Em seguida no método view, vamos criar uma variável de nome $contentview. Essa variável vai receber self::contentView($view), isso significa que, o meu método render, vai retornar ele mesmo, executando o método getContentView, que por sua vez, retorna se o arquivo existe ou não e qual o arquivo. Após especificar o que é a variável $contentView, retorno o conteúdo renderizado.
Em seguida, na minha home.php, vou chamar o método de renderização.
Para isso, devo fazer: use \App\Utils\View deixando assim acessível a classe View que contém o método de renderização;
Em seguida, retorno dentro da função getHome(que por sua vez, está sendo chamada no index.php), View::render(‘pages/home’);
Passando o parâmetro de pages/home para o método render, ele irá procurar o arquivo de nome pages/home e quando achar, retornar o seu conteúdo.


No entanto, não conseguimos seguir muito dessa forma, pois temos dados dinâmicos para colocar dentro da nossa view. A ideia é que o método render receba um array com variáveis então, no método render, vamos adicionar mais um parâmetro, o vars e no final teremos isso: public static function render($view, $vars = [ ]) 

Em seguida, voltamos para a Home.php onde vamos passar os novos parâmetros para o método render. Passaremos os novos parâmetros da seguinte forma: 

public static function getHome(){
   return View::getHome(‘pages/home’, [
      ‘name’ => ‘Joao Paulo’,
      ‘description => ‘Testes usando arquitetura MVC’’
   ]);
}

Com isso, temos que as variáveis que estamos passando como parâmetro são: 
name
description

Ao utilizarmos um debug na função, temos o seguinte:

Array
 {
	[name] => Joao Paulo
	[description] =>Testes usando arquitetura MVC
 }

Agora que temos esses dados, precisamos, dentro do arquivo home.html definir onde esses dados serão mostrados, e colocaremos eles entre chaves, assim: {{name}} e {{description}}

Em seguida, já que temos esses dois dados chegando para a gente dentro da View.php, precisamos apenas substituir esses dados. Para isso, precisamos fazer duas coisas:

Primeiro vamos descobrir os nomes dessas variáveis que vão ser substituídas;
Segundo descobrir os seus respectivos valores.

Como estamos trabalhando com arrays, temos que que as chaves são os nome das minha variáveis e o conteúdo é o valor.

Então com isso, vamos descobrir as chaves do array das variáveis. 

Para isso, dentro do método render que por sua vez está dentro da view (View.php), vou inicializar uma variável de nome $keys e vou atribuir a esta variável, as chaves dos arrays usando a função array_keys($vars). Dando um debug nessa variável, vemos o seguinte:

Array
 {
	[0] => name
	[1] => description
 }

Com essa informação, temos 50% do caminho já feito. Em seguida, iremos formatar esse array, para que ele fique condizente com as nossas variáveis de ambiente, que nesse caso seria {{name}} e {{description}}.

Para isso, iremos mapear os nossos dados usando a função array_map, dessa forma:

$keys = array_map(function($item){
   return ‘{{‘.$item.’}}’;
},$keys);

Dando um debug na variável temos o seguinte:

Array
 {
	[0] =>{{name}}
	[1] =>{{description}}
 }

O que aconteceu foi simplesmente que, a concatenação foi feita. A função array_map() passa cada elemento do array $keys para a função de retorno, criando um novo array com as chaves substituídas.

Agora que temos os dados formatados, podemos substituir os dados na nossa classe View. Faremos isso adicionando o return str_replace($keys, array_values($vars),$contentView) Onde teremos:

$keys - Contém as chaves das variáveis;
array_values($vars) - Temos os valores das variáveis
$contentView - Onde se localiza o conteúdo da view
