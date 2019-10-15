<!-- Column selectors table -->
<section id="image-grid" class="card">
          <div class="card-content">
            <br /><br />
            <img src="{{ asset('uploads/'.$index->photo) }}" style="max-height:300px; max-width:400px;" />
            <br /><br />
            {{ $index->username }}
            <br /><br />
            {{ $index->phone }}
            <br /><br />
            {{ $index->mobile }}
            <br /><br />
            {{ $index->email }}
            <br /><br />
            {{ $index->birth_date }}
            <br /><br />

          </div>
          <!--/ PhotoSwipe -->
    </section>
<!--/ Column selectors table -->
