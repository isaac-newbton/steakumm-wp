let recipePlayButton = document.getElementById('play-recipe-video')
let recipeVideo = document.getElementById('recipe-video')

if(recipeVideo && recipePlayButton) {
    let hideBtn = function(){
        recipePlayButton.style.visibility = 'hidden'
    }

    let showBtn = function(){
        recipePlayButton.style.visibility = 'initial'
    }

    recipeVideo.addEventListener('play', function(e){
        hideBtn()
    })

    recipeVideo.addEventListener('pause', function(e){
        showBtn()
    })

    recipePlayButton.addEventListener('click', function(e){
        recipePlayButton.blur()
        recipeVideo.play()
    })

    showBtn()
}