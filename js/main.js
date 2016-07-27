/*
 * +===============================================
 * | Author:        Parham Alvani (parham.alvani@gmail.com)
 * |
 * | Creation Date: 27-07-2016
 * |
 * | File Name:     main.js
 * +===============================================
 */
$(document).ready(function($) {
  $(".table-clickable > tbody > tr").click(function() {
    window.document.location = $(this).data("url")
  });
});

