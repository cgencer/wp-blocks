{{!isa:ITEM}}
          <div class="col-xs-12 {{columns}}">
            <div class="mt-lg">
              <figure class="team-member">
              {{#attachments}}
                <img src="{{guid}}" alt="attachment for {{post.post_title}}" />
              {{/attachments}}
                <figcaption>
                  <span class="title">
                    <h1 class="mt-none mb-none">{{post.post_title}}</h1>
                    <h4 class="mt-none mb-none">{{cfield.subtitle}}</h4>
                  </span>
                  <p class="description text-center">
                    <a href="{{cfield.twitter}}" class="text-white"><i class="fa fa-4x fa-twitter"></i></a>
                    <a href="{{cfield.linkedin}}" class="text-white"><i class="fa fa-4x fa-linkedin"></i></a>
                    <a href="{{cfield.facebook}}" class="text-white"><i class="fa fa-4x fa-skype"></i></a>
                  </p>
                </figcaption>
              </figure>
            </div>
          </div>
