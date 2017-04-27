@extends('layouts.app')

@section('styles')
<style>

* {
  color: #bbc0c8;
}

/* Color boxes */
.box {
  display: inline-block;
  width: 20px;
  height: 15px;
  margin: 0px;
  border: 1px solid rgba(0, 0, 0, .2);
}

.dark-teal {
  background-color: #0B486B;
}

.white {
  background-color: #ffffff;
}

.teal {
  background-color: #3B8686;
}

.green {
  background-color: #79BD9A;
}

.seafoam {
  background-color: #A8DBA8
}

.gray {
  background-color: #bbc0c8
}

/* Fonts */
.dark-teal-text {
  color: #0B486B;
}

.style-heading {
  color: #3B8686;
  border-bottom: 1px solid #083955;
  padding: 4px 0;
  margin-top: 38px;
  margin-bottom: 15px;
}

button {
  padding: 20px;
}

.text-regular {
  font-family: Lato;
  font-weight: 400;
}

.raleway {
  font-family: Raleway;
  font-weight: 400;
}

.raleway-light {
  font-family: Raleway;
  font-weight: 300;
}

.raleway-bold {
  font-family: Raleway;
  font-weight: 700;
}
</style>
@endsection

@section('content')
    <div>
    <h1>Styles</h1>
    
    <!-- Color examples -->
    <h3 class="style-heading"><b>Colors</b></h3>
    <div class="box dark-teal"></div> #0B486B
    <br>
    <div class="box teal"></div> #3B8686
    <br>
    <div class="box green"></div> #79BD9A
    <br>
    <div class="box seafoam"></div> #A8DBA8
    <br>
    <div class="box gray"></div> #BBC0C8
    <br>
    <div class="box white"></div> #FFFFFF
    
    <h3 class="style-heading"><b>Typography</b></h3>
    
    <!-- Font examples -->
    <h3>Lato Light</h3>
    <h3 class="text-regular">Lato Regular</h3>
    <h3><b>Lato Bold</b></h3>
  
    <h3 class="raleway-light">Raleway Light</h3>
    <h3 class="raleway">Raleway Regular</h3>
    <h3 class="raleway-bold">Raleway Bold</h3>

    <br>
    
    <!-- Paragraph examples -->
    <h4>Examples:</h4>
  
    <h1>h1. A very large header</h1>
    <h2 style="color:#3B8686">h2. ANOTHER LARGE HEADER</h2>
    <h3 class="dark-teal-text"><b>h3. Another header</b></h3>
    <h4>h4. A slightly smaller header</h4>
    <h5 style="color:#A8DBA8">h5. A smaller header</h5>
  
    <p><b>A paragraph.</b> Proin scelerisque sed turpis id suscipit. Duis vitae nibh id risus tristique tristique. Duis non posuere mi, nec tincidunt lectus. Praesent in ex quis libero dictum porta. Curabitur efficitur, purus vel egestas vestibulum, eros nunc rutrum ipsum, eget interdum diam turpis sed nibh.</p>
    <p class="lead"><b>p.lead paragraph.</b> Morbi vitae bibendum neque, id egestas enim. Etiam fermentum gravida orci, quis rhoncus purus aliquam non. Maecenas sit amet sapien sit amet ligula dapibus rhoncus. Nulla consectetur egestas tempor.</p>
    <p class="light text-muted"><b>p.light-text paragraph.</b> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc risus erat, vulputate vel commodo et, rutrum eu dolor. Curabitur id mauris a odio condimentum pretium. In eget aliquam tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    
    <!-- Button types -->
    <h3 class="style-heading"><b>Buttons</b></h3>
    <button type="button" class="btn my-btn btn-default btn-lg" href="#">Large Button</button>&nbsp;
    <button type="button" class="btn btn-default" href="#">Medium Button</button>&nbsp;
    <button type="button" class="btn btn-default btn-sm" href="#">Small Button</button>&nbsp;
    <button type="button" class="btn my-btn btn-default" href="#">Add Button</button>
    
    <!-- Input types -->
    <h3 class="style-heading"><b>Input</b></h3>
    <div class="input-group">
      <label for="textInput">Text Input</label>
      <input type="text" class="form-control" placeholder="Text input..." id="textInput">
    </div>
    <br>
    <div class="input-group">
      <label for="selectInput">Select Input</label>
      <select id="selectInput" class="form-control">
        <option value="option1">Option 1</option>
        <option value="option2">Option 2</option>
        <option value="option3">Option 3</option>
        <option value="option4">Option 4</option>
      </select>
    </div>
    <br>
    <div class="input-group">
      <label for="textAreaInput">Text Area Input</label>
      <textarea class="form-control" placeholder="Text Area Input" id="textAreaInput"></textarea>
    </div>
  
    <h3 class="style-heading"><b>Lists</b></h3>
  
    <!-- Unordered list -->
    <ul>
      <li>Unordered list item 1</li>
      <li>Unordered list item 2</li>
    </ul>
  
    <!-- Ordered list -->
    <ol>
      <li>Ordered list item 1</li>
      <li>Ordered list item 2</li>
    </ol>
  
  </div>
@endsection