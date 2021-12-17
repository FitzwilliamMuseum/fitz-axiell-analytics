<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="{{  route('home') }}">Fitz Axiell</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">Analytics dashboard</a>
      </li>
      <li>
        <a class="nav-link" href="{{ route('object') }}">Find an object</a>

      </li>
      <li class="nav-item">
        <a class="nav-link " aria-current="page" href="https://intranet.fitzmuseum.cam.ac.uk">Intranet</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://collection.beta.fitz.ms/">Collections Online</a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="http://adlib.fitzmuseum.cam.ac.uk/Collections/" >Axiell Collections</a>
      </li>
    </ul>
    {{ \Form::open(['url' => route('object.results'),'method' => 'GET', 'class' => 'form-inline ml-auto']) }}
  <label for="search" class="sr-only">Search: </label>
  <input id="query" name="query" type="text" class="form-control mr-sm-2"
  placeholder="Search for an object" required value="{{ old('query') }}" aria-label="Your query">
  <button type="submit" class="btn btn-outline-light my-2 my-sm-0" id="searchButton" aria-label="Submit your search">Search</button>
{!! Form::close() !!}
  </div>
</nav>
