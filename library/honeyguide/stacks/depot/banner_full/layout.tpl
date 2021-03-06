{{!isa:ITEM}}
{{#set.items}}
      <section class="section-full-height mt-xxxlg editable editable_image" style="background-image: url(../images/{{images.background}});">
        <div class="section-full-height col-xs-offset-2 col-xs-10 col-md-offset-5 col-md-7 bg-secondary">
          <div class="middle">
            <div class="container-fluid">
              <div class="row">
                <div class="col-xs-offset-1">
                  <h1 class="lead text-primary editable editable_textfield">{{strings.title}}</h1>
                  <h3 class="lead text-primary editable editable_textfield">{{strings.subtitle}}</h3>
                  <a href="#" class="btn btn-primary btn-lg">Read more</a> <a href="{{dllink}}" class="btn btn-default-o btn-lg">Download</a>
                </div>
              </div> <!--/.row-->
            </div>
          </div>
        </div>
      </section>
{{/set.items}}