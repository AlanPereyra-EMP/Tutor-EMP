var stars = document.querySelectorAll('.tutor-star-rating-group i');
for (var i = 0; i < stars.length; i++) {
  stars[i].addEventListener('click', tutorShowSelectedStars, false);
}

function tutorShowSelectedStars(){
  var length = this.dataset.ratingValue;
  for(var i = 1; i < 5; i++){
    stars[i].classList.remove('tutor-icon-star-full');
    stars[i].classList.add('tutor-icon-star-line');
  }
  for(var j = 0; j < length; j++){
    stars[j].classList.remove('tutor-icon-star-line');
    stars[j].classList.add('tutor-icon-star-full');
  }
}
