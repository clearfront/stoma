$(document).ready(function(){$("#submit-nurse").click(function(){$("#nurse-form").submit()}),$("#submit-admin").click(function(){$("#admin").submit()}),$("#submit-search").click(function(){$("#search").submit()}),$(".select-button").click(function(){$(".question-info").hide(),$(".question-confirm").show()}),$(".choose-button").click(function(){$(".question-info").show(),$(".question-confirm").hide()}),$(".double-select-button-one").click(function(){$(".double-question-info-one").hide(),$(".double-question-info-two").show(),$(".target2").show()}),$(".double-select-button-two").click(function(){$(".double-question-info-two").hide(),$(".double-question-confirm").show()}),$(".double-choose-button").click(function(){$(".double-question-info-two").hide(),$(".double-question-confirm").hide(),$(".double-question-info-one").show()}),$.validate()});