## Objetivos do projeto

O **Cultura Baiana Musical Graph** tem como objetivo estruturar, sistematizar e publicar grafos JSON-LD personalizados para conteúdos relacionados à cultura musical baiana, articulando dados biográficos, obras musicais, fontes documentais, instituições, acervos e territórios culturais.

A proposta parte da necessidade de ampliar a legibilidade semântica de conteúdos musicais e culturais na web, criando uma camada de dados estruturados capaz de qualificar a mediação entre páginas institucionais, mecanismos de busca, acervos digitais e futuras aplicações baseadas em grafos de conhecimento.

### Objetivo geral

Desenvolver uma metodologia técnica e semântica para inserção de grafos JSON-LD em conteúdos WordPress relacionados à cultura musical baiana, com foco na organização, contextualização e circulação qualificada de informações sobre agentes, obras, documentos, instituições e territorialidades musicais.

### Objetivos específicos

* Permitir a inserção manual de grafos JSON-LD em páginas, posts e custom post types do WordPress.
* Apoiar a estruturação semântica de páginas biográficas de músicos, compositoras, professores, intérpretes, pesquisadores e demais agentes culturais.
* Criar condições técnicas para representar obras musicais, partituras, gravações, documentos, acervos, instituições e eventos culturais em formato estruturado.
* Favorecer a indexação qualificada dos conteúdos por mecanismos de busca, ampliando a compreensão das relações entre pessoas, obras, lugares, instituições e fontes documentais.
* Contribuir para a construção progressiva de uma base de conhecimento sobre a cultura musical baiana, com potencial de articulação futura com ontologias, linked data e acervos digitais.
* Estabelecer uma camada inicial de interoperabilidade entre produção acadêmica, documentação histórica, patrimônio musical e tecnologias de dados estruturados.
* Possibilitar que conteúdos culturais dispersos sejam organizados em uma lógica de grafo, valorizando relações de historicidade, territorialidade, autoria, circulação, formação musical e institucionalidade.
* Criar uma base técnica extensível para futuras interfaces administrativas, templates de schemas, validação de JSON-LD e geração assistida de grafos musicais.

### Problematização

Grande parte dos conteúdos sobre música, cultura e patrimônio documental aparece na web de forma textual, fragmentada e pouco estruturada. Essa forma de publicação limita a capacidade dos sistemas digitais de compreenderem relações fundamentais, como autoria, vínculo institucional, localização territorial, cronologia, circulação de obras e conexão entre documentos.

O projeto busca intervir nessa limitação por meio da produção de uma camada semântica complementar, sem substituir o conteúdo narrativo das páginas. O JSON-LD atua como uma mediação entre a materialidade documental do conteúdo e sua leitura por máquinas, favorecendo maior densidade informacional, coerência estrutural e possibilidade de reutilização futura dos dados.

### Perspectiva metodológica

A metodologia inicial do plugin consiste na inserção controlada de grafos JSON-LD em conteúdos singulares do WordPress. Cada página pode receber um grafo próprio, adequado à sua natureza documental, biográfica, musical ou institucional.

Em sua primeira etapa, o projeto prioriza a simplicidade operacional: o usuário insere manualmente o JSON-LD em um campo personalizado, e o plugin valida e imprime esse grafo no `<head>` da página. Essa escolha permite testar a viabilidade técnica da proposta antes da implementação de uma interface administrativa mais complexa.

Em etapas futuras, a metodologia poderá ser ampliada para incluir modelos específicos de schemas, validação automatizada, campos estruturados, integração com ACF, custom post types e padrões ontológicos próprios para a documentação musical.

## Visão de longo prazo

O Cultura Baiana Musical Graph não se limita à emissão de JSON-LD em páginas WordPress. O projeto busca estabelecer uma infraestrutura de representação semântica para a documentação da cultura musical baiana, permitindo a articulação progressiva entre pessoas, obras, instituições, acervos, documentos, eventos e territórios culturais.

A longo prazo, o projeto poderá incorporar modelos ontológicos próprios, interoperabilidade com padrões internacionais de linked data e mecanismos de exploração baseados em grafos de conhecimento.

## Escopo da versão atual

A versão 0.1.0 possui apenas uma funcionalidade:

- leitura de um campo contendo JSON-LD;
- validação básica do conteúdo;
- impressão do grafo no elemento `<head>` da página.

Não há geração automática de schemas, interface administrativa própria, validação semântica ou integração com ontologias nesta versão.

## Licença

Distribuído sob a licença GNU General Public License v2.0 ou posterior
(GPL-2.0-or-later), conforme a convenção dos plugins WordPress.
O texto completo está no arquivo `LICENSE`.