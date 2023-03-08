<!doctype html>
<html lang="en">
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="José Igor | @j.igr ">
		<meta http-equiv="refresh" content="60" >
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Expires" content="0">
		<!--<script>
			/*const test = prompt("Nome: ", "Senha");*/

			let igor = prompt("Insira o seu nome de usuário:");

			while (!/^[a-zA-Z0-9]{4,}$/.test(igor)) {
				alert("Nome de usuário inválido. Ele deve conter pelo menos 4 caracteres alfanuméricos.");
				igor = prompt("Por Favor, Insira o seu nome de usuário:");
			}

			alert(`Bem-vindo, ${igor}!`);

		</script>
		-->
		<title>Envie sua mensagem</title>
    
    
		<link  rel="icon" href="./css/favicon.png" type="image/png" />
		<link href="./vendor/emoji-picker/lib/css/emoji.css" rel="stylesheet">
		<script src="./vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="./vendor/emoji-picker/lib/js/config.js"></script>
		<script src="./vendor/emoji-picker/lib/js/util.js"></script>
		<script src="./vendor/emoji-picker/lib/js/jquery.emojiarea.js"></script>
		<script src="./vendor/emoji-picker/lib/js/emoji-picker.js"></script>

		<!-- Bootstrap core CSS -->
		<link href="./dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- estilo customizado para esse template -->
		<link href="./assets/sticky-footer-navbar.css" rel="stylesheet">
		<link href="./style.css" rel="stylesheet">
    </head>

    <body>

<!-- conteudo com style do h1 e body-->
		<h1 style="padding-bottom: 0; 
				margin: 0 auto;
				/*margin-left: 350px;*/
				background-image: url(./imagens/logo.png); height: 163px;
				background-repeat: no-repeat;
				display: block;
				/*margin-left: auto;
				margin-right: auto;*/
				width: 50%;
				" >
		</h1>
		<hr> 
<div class="container">
      <h3 class="mt-5" style="padding-top: 0;"><center>Sua opnião é importante</center></h3>
      <hr>
      <div class="row">
    <div class="col-12 col-md-12"> 
          <!-- Conteudo -->

<div class="output-container">
<div class="comment-form-container">
<form id="frm-comment">
<div class="input-row">
    <input type="hidden" name="comment_id" id="commentId" placeholder="Name" /> 
    <input class="form-control" type="text" name="name" id="name" placeholder="nome" />
</div>

<!-- Area de Texto para input dos comentarios-->
<div class="input-row">
    <p class="emoji-picker-container">
      <textarea class="input-field" data-emojiable="true" data-emoji-input="unicode" type="text" name="comment" id="comment" placeholder="sua mensagem"></textarea>
    </p>
</div>

<!--
	BUTTON DO COMENTAR
	commentID CHAMA O INPUT NO SCRIPT E ENVIA PARA AS REPLYS
-->

<button
 	type="submit" class="btn btn-primary"
	id="submitButton"
	style="margin-left: 350px;
	border-radius:30px;
	height:50px;">
	Comentar
</button>

<div>
	<!--input button (botão comentar =>
	 lembrar de passar metodo type submit button)
	-->
	
<!--
    <input style="height: 60px; border-radius:30px;
	margin-left:350px; text-shadow: 0.4px 0.4px #ffff;
	font-weight:bold;" 
	type="button" class="btn btn-primary" 
	id="submitButton" value="Comentar"/>
	<div id="comment-message">Comentario Criado</div> 
-->
</div>

</form>
<!-- Saida do script post dos comentarios-->
</div>
	<div id="output">
	</div>
</div>

<script>

/* //Função para focar no input name e inserir resposta
function postReply(commentId) {
	$('commentId').val(commentId);
	$("name").focus();
}
*/

$("#submitButton").click(function () {
	$("#comment-message").css('display', 'none');
	var str = $("#frm-comment").serialize();
	
	$.ajax({
		url: "AgregarComentario.php",
		data: str,
		type: 'post',
		success: function (response)
		{
			//limpando dados ao enviar para o reply
			$("#comment-message").css('display', 'inline-block');
			$("#name").val("");
			$("#comment").val("");
			$("#commentId").val("");
			listComment();
		}
	});
});

/* 	********	SUBMIT DO BUTTON RESPOSTA	********  */

$("#submitBtn").click(function () {
	$("#comment-message").css('display', 'none');
	var str = $("#frm-btn").serialize();

	$.ajax({
		url: "AgregarComentario.php",
		data: str,
		type: 'post',
		success: function (response)
		{
			//limpando dados ao enviar para o reply
			$("#comment-message").css('display', 'inline-block');
			$("#name").val("");
			$("#comment").val("");
			$("#commentId").val("");
			listComment();
		}
	});
});

/*  ****************************************************  */

$(document).ready(function () {
	listComment();
});

$(function () {
	// Inicialização e criação emoji set from sprite sheet
	window.emojiPicker = new EmojiPicker({
		emojiable_selector: '[data-emojiable=true]',
		assetsPath: './vendor/emoji-picker/lib/img/',
		popupButtonClasses: 'icon-smile'
	});

	window.emojiPicker.discover();
});

function listComment() {
$.post("ListaComentario.php",
function (data) {
	var data = JSON.parse(data);

	var comments = "";
	var replies = "";
	var item = "";
	var parent = -1;
	var results = new Array();

	var list = $("<ul class='outer-comment'>");
	var item = $("<li>").html(comments);

	for (var i = 0; (i < data.length); i++)
	{
		var commentId = data[i]['co_id'];
		parent = data[i]['parent_id'];

		if (parent == "0")
		{
			comments =  "<div class='comment-row'>"+
			"<div class='comment-info'><img src='user-30.png'><span class='posted-by'>" + data[i]['comentario_nombre'].toUpperCase() + "</span></div>" + 
			"<div class='comment-text'>" + data[i]['comentarios'] + "</div>"+			
			"<form id='frm-btn'><div class='input-row'><input type='hidden' name='comment_id' id='commentId' placeholder='Name' /><textarea class='resposta' type='text' name='comment' id='comment' /></div><button class='btn-reply' type='submit' id='submitBtn' >Responder</button></form>"+
			/*"<div><a class='btn-reply' id='submit' onClick='postReply(" + commentId + ")'>Responder</a></div>"+*/
			/*"<div><button class='btn-reply' type='submit' id='submitBtn' onClick='postReply(" + commentId + ")'>Responder</button></div>"+*/
			"</div>";
			var item = $("<li>").html(comments);
			list.append(item);
			var reply_list = $('<ul>');
			item.append(reply_list);
			listReplies(commentId, data, reply_list);
		}
	}
	$("#output").html(list);
});
}

function listReplies(commentId, data, list) {

	for (var i = 0; (i < data.length); i++)
	{
		if (commentId == data[i].parent_id)
		{
			var comments = "<div class='comment-row'>"+
			" <div class='comment-info'><img src='reply.png'><span class='posted-by'>" + data[i]['comentario_nombre'].toUpperCase() + " </span></div>" + 
			"<div class='comment-text'>" + data[i]['comentarios'] + "</div>"+
			"<div><input type='hidden' name='comment_id' id='commentId' placeholder='Name' /><textarea name='resposta' class='resposta' /></div>"+
			/*"<div><a class='btn-reply' id='submit' onClick='postReply(" + data[i]['co_id'] + ")'>Responder</a></div>"+*/
			"<div><button class='btn-reply' type='submit' id='submitBtn' onClick='postReply(" + data[i]['co_id'] + ")'>Responder</button></div>"
			"</div>";
			var item = $("<li>").html(comments);
			var reply_list = $('<ul>');
			list.append(item);
			item.append(reply_list);
			listReplies(data[i].co_id, data, reply_list);

		}
	}
}

</script>
<!-- Fim do Conteudo --> 
        </div>
  </div>
<!-- Fim row --> 
    </div>
<!-- Fim do container -->
<footer class="footer" style="border-radius: 100px; background-color: rgba(215, 243, 250, 0.466);">
    <div class="container">
		<span class="text-muted">
			<p>
				<strong>Visite </strong><a href="http://192.168.1.3/" target="_blank">Intranet</a>
			</p>
        </span>
	</div>
</footer>
<!-- Bootstrap core JavaScript--> 
<script src="./dist/js/bootstrap.min.js"></script> 
</body>
</html>
