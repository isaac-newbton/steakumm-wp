const api = 'https://s.allebach.com';
const apiInsta = `${api}/instagram`;
const apiTwitter = `${api}/twitter`;

let request = obj => {
    return new Promise((resolve, reject) => {
        let xhr = new XMLHttpRequest();
        xhr.open(obj.method || 'POST', obj.url);
        if (obj.headers) {
            Object.keys(obj.headers).forEach(key => {
                xhr.setRequestHeader(key, obj.headers[key]);
            });
        }
        xhr.responseType = 'json';
        xhr.onload = () => {
            if (xhr.status >= 200 && xhr.status < 300) {
                resolve(xhr.response);
            } else {
                reject(xhr.statusText);
            }
        };
        xhr.onerror = () => reject(xhr.statusText);
        xhr.send(obj.body);
    });
};

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.social-feed-block').forEach((feedblock) => {
        const instaAccount = feedblock.dataset.insta;
        const twitterAccount = feedblock.dataset.twitter;

        const instaposts = request({
            url: apiInsta,
            headers: {
                profile: instaAccount,
                count: 4
            }
        });

        const tweets = request({
            url: apiTwitter,
            headers: {
                profile: twitterAccount,
                count: 2
            }
        });
        let postDom = '';
        Promise.all([instaposts, tweets])
            .then((data) => {
                console.log(data);
                // parse instagram data

                if(data[0]){
                    postDom += "<div class='row instagram'>"
                        for (const post of data[0]) {
                            postDom += "<figure><a href='https://www.instagram.com/p/" + post.url_code + "'>";
                            postDom += "<img src='" + post.img_src + "'></a>";
                            postDom += '<span class="corner fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x"></i><i class="fab fa-instagram fa-stack-1x fa-inverse"></i></span>';
                            postDom += '<span class="middle fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x"></i><i class="fab fa-instagram fa-stack-1x fa-inverse"></i></span></figure>';
                        }
                    postDom += "</div>";
                }

                // parse twitter data
                postDom += "<div class='row twitter'>"
			    if(data[1].tweets!=null){
                	for (const post of data[1].tweets) {
                        console.log(post.html);
                    	postDom += "<div><div class='tweet-wrap'>";
                    	postDom += "<div class='profile'><figure><a href='https://twitter.com/" + data[1].account.name + "'><img src='" + data[1].account.profile_pic +"' alt='Profile Picture'></a></figure><div class='name'>";
                    	postDom += "<a href='https://twitter.com/" + data[1].account.name + "'>" + data[1].account.full_name + '</a>';
                    	postDom += "<span>@" + data[1].account.name + '</span>';
                    	postDom += "</div></div>" + decodeURI(post.html);
                        console.log(post.html);
                        console.log(decodeURI(post.html));
                    	postDom += '<span class="corner fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x"></i><i class="fab fa-twitter fa-stack-1x fa-inverse"></i></span></div></div>';
                	}
				}
                postDom += "</div>";
                feedblock.innerHTML = postDom;
                // addLoadEvent(customizeTweet);
                // trigger twitter embeds to format themselves
                // twttr.widgets.load();
            });
    });
});