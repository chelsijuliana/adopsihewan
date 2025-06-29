<form action="{{ route('dokter.rekam-medis.store', $hewan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Tanggal Pemeriksaan</label>
        <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
    </div>

    <div class="mb-3">
        <label>Kondisi Hewan</label>
        <textarea name="kondisi" class="form-control" rows="2" required></textarea>
    </div>

    <div class="mb-3">
        <label>Vaksinasi</label>
        <textarea name="vaksinasi" class="form-control" rows="2"></textarea>
    </div>

    <div class="mb-3">
        <label>Upload File Hasil Pemeriksaan (opsional)</label>
        <input type="file" name="file_hasil" class="form-control">
    </div>

    <div class="mb-3">
        <label>Layak Diadopsi?</label>
        <select name="layak_adopsi" class="form-control" required>
            <option value="0">❌ Tidak</option>
            <option value="1">✅ Ya</option>
        </select>
    </div>

    <button class="btn btn-primary">Simpan Rekam Medis</button>
</form>
