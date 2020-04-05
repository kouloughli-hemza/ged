<div id="scannerUploader">
  <h3>@lang('Scan the document')</h3>
  <section>   
    <p class="text-danger mt-1 mg-b-20" id="download-app" style="display:none;">@lang('No Scan application found in your machine. Please download, install and open first then refresh the browser.')
     <a href="{{ route('files.download-app') }}" download>@lang('Download app')</a>
    </p>

    {{-- Start Preview Image scanned Section --}}
      <div class="row" id="th_container">
        <div class="col-md-12 mb-1 text-secondary" id="th_container_empty">@lang('No scanned document')</div>
      </div>

    {{-- End Scanned Image preview Section --}}

    {{-- Start Scanners List --}}
    <select class="custom-select mg-t-10" id="sources-list">
      <option selected disabled>@lang('Select a scanner')</option>
    </select>
    {{-- End Scanners List --}}

    {{-- Scan Button --}}
    <div class="col-md-10 mx-auto mg-t-20">
      <button id="btn-scan" class="btn btn-brand-02 btn-block" style="display:none">@lang('Scan the document')</button>
    </div>
    {{-- End Scan Button --}}
    <button class="btn btn-success" id="btn-upload" style="display:none;">Terminer</button>

  </section>



  <h3>@lang('Document information')</h3>
  <section>
    <p class="text-danger" id="uploadServerError" style="display: none">@lang('An unexpected error occurred please try again later')</p>
    @include('file-manager.partials.wizard.document-details')
  </section>
</div>