/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
             //indo de uma sessãos do site para outra
             function home(){
             $('#home').slideUp(200);
             $('#sobre').slideUp(200);
             $('#portifolioCategorias').slideUp(200);
             $('#contato').slideUp(200);
             
             $('#home').slideDown(200);
             
             $('.toSobre').css('color', 'black');
             $('.toPortifolio').css('color', 'black');
             $('.toContato').css('color', 'black');
             
             }
             
             function sobre(){
             $('#home').slideUp(200);
             $('#sobre').slideUp(200);
             $('#portifolioCategorias').slideUp(200);
             $('#contato').slideUp(200);
             
             $('#sobre').slideDown(200);
             
             $('.toSobre').css('color', 'green');
             $('.toPortifolio').css('color', 'black');
             $('.toContato').css('color', 'black');
             
             }
             
             function portifolio(){
             $('#home').slideUp(200);
             $('#sobre').slideUp(200);
             $('#portifolioCategorias').slideUp(200);
             $('#contato').slideUp(200);
             
             $('#portifolioCategorias').slideDown(200);
             
             $('.toPortifolio').css('color', 'green');
             $('.toSobre').css('color', 'black');
             $('.toContato').css('color', 'black');
             
             }
             
             function contato(){
             $('#home').slideUp(200);
             $('#sobre').slideUp(200);
             $('#portifolioCategorias').slideUp(200);
             $('#contato').slideUp(200);
             
             $('#contato').slideDown(200);
             
             $('.toContato').css('color', 'green');
             $('.toSobre').css('color', 'black');
             $('.toPortifolio').css('color', 'black');
             
             }
             
             //vindo de portifolio para as outras sessões do site
             
             function sobre2(){
                $('#principal').slideUp(200);
                $('#logotipos').slideUp(200);
                $('#impressos').slideUp(200);
                $('#sites').slideUp(200);
                $('#outros').slideUp(200);
                
             
             
             $('#home').hide();
             $('#sobre').hide();
             $('#portifolioCategorias').hide();
             $('#contato').hide();
             
             $('#principal').show();
              $('#sobre').slideDown(200);
             
             $('.toSobre').css('color', 'green');
             $('.toPortifolio').css('color', 'black');
             $('.toContato').css('color', 'black');
             
             }
             
             function portifolio2(){
                $('#principal').slideUp(200);
                $('#logotipos').slideUp(200);
                $('#impressos').slideUp(200);
                $('#sites').slideUp(200);
                $('#outros').slideUp(200);
                
             
             
             $('#home').hide();
             $('#sobre').hide();
             $('#portifolioCategorias').hide();
             $('#contato').hide();
             
             $('#principal').show();
              $('#portifolioCategorias').slideDown(200);
             
             $('.toSobre').css('color', 'black');
             $('.toPortifolio').css('color', 'green');
             $('.toContato').css('color', 'black');
             
             }
             
             
             function contato2(){
                $('#principal').slideUp(200);
                $('#logotipos').slideUp(200);
                $('#impressos').slideUp(200);
                $('#sites').slideUp(200);
                $('#outros').slideUp(200);
                
             
             
             $('#home').hide();
             $('#sobre').hide();
             $('#portifolioCategorias').hide();
             $('#contato').hide();
             
             $('#principal').show();
              $('#contato').slideDown(200);
             
             $('.toSobre').css('color', 'black');
             $('.toPortifolio').css('color', 'black');
             $('.toContato').css('color', 'green');
             
             }
             
             
             
             //categorias do portifolio
             function logotipos(){
                $('#principal').slideUp(200);
                $('#logotipos').slideUp(200);
                $('#impressos').slideUp(200);
                $('#sites').slideUp(200);
                $('#outros').slideUp(200);
                
                $('#logotipos').slideDown(200);
                
             }
             
              function impressos(){
                $('#principal').slideUp(200);
                $('#logotipos').slideUp(200);
                $('#impressos').slideUp(200);
                $('#sites').slideUp(200);
                $('#outros').slideUp(200);
                
                $('#impressos').slideDown(200);
                
             }
             
              function sites(){
                $('#principal').slideUp(200);
                $('#logotipos').slideUp(200);
                $('#impressos').slideUp(200);
                $('#sites').slideUp(200);
                $('#outros').slideUp(200);
                
                $('#sites').slideDown(200);
                
             }
             
              function outros(){
                $('#principal').slideUp(200);
                $('#logotipos').slideUp(200);
                $('#impressos').slideUp(200);
                $('#sites').slideUp(200);
                $('#outros').slideUp(200);
                
                $('#outros').slideDown(200);
                
             }
             
             
             //visualizador de imagem
             function exibirImagem(imagem, alvo){
                
                 //DEFINE LARGURA E ALTURA ÚTIL DO NAVEGADOR
		var x, y;
        if (window.innerHeight) //navegadores baseados em mozilla , IE9
		{ 
			y = window.innerHeight; 
			x = window.innerWidth;
		}
		else
		{ 
			if (document.body.clientHeight)  //Navegadores baseados em IExplorer, IE5(BARRA LATERAL DUPLA)
			{ 
				y = document.body.clientHeight;
				x = document.body.clientWidth;
			}
			else //outros navegadores , IE8, IE7(BARRA LATERAL INUTILIZADA)
			{ 
				y = 768;
				x = 1024;
			} 
		}
                
                $('#visualizar').fadeIn(1000);
                $('#todo').fadeOut(1000);
                //$('#todo').animate({opacity: 0},100);
                //$('#todo').css('position', 'fixed');
               
                
                $('#quadro #imagem').remove();
                $imagem = $('<img id="imagem" src="img/'+ imagem +'"  onclick="ocultarImagem( \''+alvo+'\');" title="clique para fechar" />');
                $('#quadro').append($imagem);
                $imagem.hide();
                
                //$('#voltar img').remove();
                //$voltar = $('<img src="img/fechar.png" onclick="ocultarImagem( \''+alvo+'\');" alt="" />');
                //$('#voltar').append($voltar);

                 //alert("2 "+alvo);
                $imagem.load(function() {
                  // alert( $imagem.width()+ "x"+ $imagem.height() ); 
                  margem = 10;
                  multiplicadorLargura = (x - margem) / $imagem.width();
                  multiplicadorAltura = (y - margem) / $imagem.height();
                  
                  if(multiplicadorLargura <= multiplicadorAltura){
                      //use largura
                      alturaImagem = $imagem.height() *  multiplicadorLargura;
                      larguraImagem = $imagem.width() * multiplicadorLargura; 
                  }
                  else{
                      //ese altura
                      alturaImagem = $imagem.height() * multiplicadorAltura;
                      larguraImagem = $imagem.width() * multiplicadorAltura; 
                  }
                  //$imagem.defineProperty('width',larguraImagem);
                  //$imagem.defineProperty('height',alturaImagem );
                  
                  $imagem.fadeIn(1000);
                  $imagem.animate({ width: larguraImagem }, 1000);
                  $imagem.animate({ height: alturaImagem }, 1000);
                    });
  
               
              
               
               
               
            }   
            function exibirImagem2(imagem, alvo){
                
                 //DEFINE LARGURA E ALTURA ÚTIL DO NAVEGADOR
		var x, y;
        if (window.innerHeight) //navegadores baseados em mozilla , IE9
		{ 
			y = window.innerHeight; 
			x = window.innerWidth;
		}
		else
		{ 
			if (document.body.clientHeight)  //Navegadores baseados em IExplorer, IE5(BARRA LATERAL DUPLA)
			{ 
				y = document.body.clientHeight;
				x = document.body.clientWidth;
			}
			else //outros navegadores , IE8, IE7(BARRA LATERAL INUTILIZADA)
			{ 
				y = 768;
				x = 1024;
			} 
		}
                
                $('#visualizar').fadeIn(1000);
                $('#todo').fadeOut(1000);
               
                $('#quadro #imagem').remove();
                $imagem = $('<img id="imagem" src="img/'+ imagem +'"  onclick="ocultarImagem( \''+alvo+'\');" title="clique para fechar" />');
                $('#quadro').append($imagem);
                $imagem.hide();
               
                $imagem.load(function() {
                  // alert( $imagem.width()+ "x"+ $imagem.height() ); 
                  margem = 30;
                  multiplicadorLargura = (x - margem) / $imagem.width();
                  //multiplicadorAltura = (y - margem) / $imagem.height();
                  
                 
                      //use largura
                      alturaImagem = $imagem.height() *  multiplicadorLargura;
                      larguraImagem = $imagem.width() * multiplicadorLargura; 
                
                  $imagem.fadeIn(1000);
                  $imagem.animate({ width: larguraImagem }, 1000);
                  $imagem.animate({ height: alturaImagem }, 1000);
                  //$('html, body').animate({ scrollTop: 0}, 1000);
                    });
  
               
              
               
               
               
                }
            function ocultarImagem(alvo){
           
               // $('#todo').css('opacity', 1 );
                //$('#todo').css('position', 'static');
                
                $('#visualizar').fadeOut(1000);
                $('#todo').fadeIn(1000);
                //$('#todo').animate({opacity: 1},1000);
                //alert(alvo);
                $('html, body').animate({ scrollTop: $(alvo).offset().top}, 1000);
                
            }



