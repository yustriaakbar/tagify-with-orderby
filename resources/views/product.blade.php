<html>
    <title>Tagify</title>
    <style>
        .tagify{    
        width: 100%;
        max-width: 700px;
        }

        .tags-look .tagify__dropdown__item{
        display: inline-block;
        border-radius: 3px;
        padding: .3em .5em;
        border: 1px solid #CCC;
        background: #F3F3F3;
        margin: .2em;
        font-size: .85em;
        color: black;
        transition: 0s;
        }

        .tags-look .tagify__dropdown__item--active{
        color: black;
        }

        .tags-look .tagify__dropdown__item:hover{
        background: lightyellow;
        border-color: gold;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <body>
        <div class="container m-5">
            <form action="{{ route('update.card', $card['id']) }}" method="post">
                @csrf
                @php
                if($card['multiple_product'] != null) {
                    $json_card = $card['multiple_product'];
                } else {
                    $json_card = '[]';
                }
                @endphp
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Multiple Card</label>
                <div class="col-auto">
                    <input class="form-control" name='tags' value="{{ $json_card }}" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Save</button>
                </div>
            </div>
            </form>
            <br><br><br><br><br><br>
            <div class="row">
                <h3 class="mb-3">Result products in tagify with orderBy</h3>
                @foreach ($listProduct as $item)
                <div class="col-sm-4">
                  <div class="card">
                    <div class="card-header">
                        {{ $item->title }}
                      </div>
                    <div class="card-body">
                      <p class="card-text">{{ $item->description }}</p>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
        </div>
        <script src="https://unpkg.com/@yaireo/tagify"></script>
        <script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
        <script>
            var input = document.querySelector('input[name="tags"]');

            var tagify = new Tagify(input, {
                whitelist:@json($collectProduct).map(({
                        id,
                        name
                    }) => ({
                        value: id,
                        name
                    })),
                maxTags: 10,
                tagTextProp: 'name',
                dropdown: {
                    maxItems: 20,
                    mapValueTo: 'name',          
                    classname: "tags-look", 
                    enabled: 0,            
                    closeOnSelect: false   
                }
            })
        </script>
    </body>
</html>