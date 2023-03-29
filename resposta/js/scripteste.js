

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
/*
A função $().click() é usada para definir um evento de clique para o botão "Enviar" 
que envia o formulário de comentário para o servidor usando uma solicitação Ajax.
*/
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
/*
 A função $(document).ready() é usada para chamar a função listComment() 
 quando a página é carregada, para exibir a lista de comentários e respostas iniciais. 
 */
$(document).ready(function () {
	listComment();
});
/*
A função $(function()) é usada para inicializar um seletor de emojis,
 permitindo que os usuários adicionem emojis aos seus comentários.
*/
$(function () {
	// Inicialização e criação emoji set from sprite sheet
	window.emojiPicker = new EmojiPicker({
		emojiable_selector: '[data-emojiable=true]',
		assetsPath: './vendor/emoji-picker/lib/img/',
		popupButtonClasses: 'icon-smile'
	});

	window.emojiPicker.discover();
});
/* A função listComment() é usada para exibir uma lista 
de comentários e respostas existentes no sistema de comentários.
Ele faz uma solicitação Ajax para pegar os dados do servidor e em depois
usa jQuery para criar elementos HTML para mostrar os comentários e respostas. */
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
/*
A função listReplies(commentId, data, list) é usada para exibir uma lista de respostas
 a um comentário específico. Ele é chamado dentro da função listComment() para exibir
  as respostas dentro do comentário correspondente.
*/
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
