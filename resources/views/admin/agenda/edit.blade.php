@extends('admin.layouts.admin')
@section('title', 'Edit Agenda')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
  <h2 class="text-2xl font-bold text-blue-700 mb-4">Edit Agenda</h2>

  <form id="editAgendaForm" method="POST" action="{{ route('admin.agenda.update', $agenda) }}">
    @csrf
    @method('PUT')

    @include('admin.agenda.form', ['agenda' => $agenda])

    <div class="text-right mt-6">
      <a href="{{ route('admin.agenda.index') }}"
         class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mr-2">
        Batal
      </a>

      <button type="button" id="confirmUpdateBtn"
              class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Perbarui
      </button>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('editAgendaForm');
  const btn = document.getElementById('confirmUpdateBtn');

  if (btn && form) {
    btn.addEventListener('click', function () {
      Swal.fire({
        title: 'Yakin ingin memperbarui agenda ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, perbarui!',
        cancelButtonText: 'Batal',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          // Pastikan form benar-benar dikirim
          form.submit();
        }
      });
    });
  }
});
</script>
@endpush
