// //// ポップアップ

// // アラートポップアップ
// alert("alart!!");

// // 確認ポップアップ
// var result = confirm("OK?");
// console.log(result);

// // 入力ポップアップ
// var answer = prompt("What your name?", "No name");
// console.log(answer);

// // 関数
// function hello(name) {
// 	var greet = "hello " + name;
// 	return greet;
// }
// console.log(hello("Tom"));

// // 無名関数
// var hello = function(name) {
// 	var greet = "hello " + name;
// 	return greet;
// }
// console.log(hello("Bob"));

// // 即時関数
// (function(name) {
// 	var greet = "hello " + name;
// 	console.log(greet);
// })("Sam");

// // 繰り返し処理（よく分からん）
// var count = 0;
// function countUp() {
// 	var time_id = setTimeout(function() {
// 		countUp()
// 	}, 1000);
// 	console.log(count++);
// 	if(count > 3) {
// 		clearTimeout(time_id);
// 	}
// }
// countUp();

// // 配列
// var score = [100, 200, 500];
// console.log(score[1]);

// // オブジェクト
// var user = {
// 	email: "example@gmail.com",
// 	score: 80,
// }
// console.log(user.email);

// // メソッド
// var user = {
// 	email: "example@gmail.com",
// 	greet: function(name) {
// 		console.log("hello " + name);
// 		console.log(this.email);
// 	}
// }
// user.greet("Tom");

// // ajax書き方1
// $(function() {
// 	$("#greet").click(function() {
// 		$.ajax({
// 			url:"greet.php",
// 			type: "GET",
// 			dataType: 'json',
// 			data: {
// 				test: $("#test").val()
// 			}
// 		})
// 		.done(function(data) {
// 			$("#result").html(data.message + "(" + data.length + ")");
// 		});
// 	});
// });


// ajax書き方2
$(function() {
	$("#greet").click(function() {
	$.get("greet.php", {
			test: $("#test").val()
		}, function(data) {
			$("#result").html(data.message + "(" + data.length + ")");
		});
	});
});