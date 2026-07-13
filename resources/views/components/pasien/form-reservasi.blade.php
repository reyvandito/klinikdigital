@props(['dokters' => []])

@php
/** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Dokter[] $dokters */
/** @var \App\Models\Dokter $dokter */
@endphp

<div>
    @if(session('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl flex items-start gap-3">
            <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
            <div>
                <p class="font-medium">Terjadi Kesalahan</p>
                <p class="text-sm">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <form action="{{ route('pasien.reservasi.store') }}" method="POST" id="reservasiForm">
        @csrf
        <div class="space-y-6">
            
            {{-- STEP 1: Pilih Dokter --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                    <i class="fas fa-user-md text-blue-500 mr-1"></i> Pilih Dokter <span class="text-red-500">*</span>
                </label>
                
                {{-- SEARCH & FILTER --}}
                <div class="bg-gray-50 rounded-xl p-4 mb-4 border border-gray-200">
                    <div class="flex flex-col md:flex-row gap-3">
                        {{-- Search --}}
                        <div class="flex-[2] relative">
                            <input type="text" 
                                   id="searchDokter"
                                   placeholder="Cari dokter berdasarkan nama atau spesialis..." 
                                   class="w-full px-4 py-2.5 pl-10 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        </div>
                        
                        {{-- Filter Spesialis --}}
                        <div class="flex-[3] flex flex-wrap items-center gap-2">
                            <span class="text-xs font-semibold text-gray-500 flex items-center gap-1">
                                <i class="fas fa-filter text-blue-500"></i> Filter:
                            </span>
                            <button type="button" 
                                    class="filter-spesialis px-3 py-1.5 bg-blue-500 text-white rounded-lg text-xs font-semibold transition hover:bg-blue-600"
                                    data-spesialis="">
                                Semua
                            </button>
                            @php
                                $spesialisList = App\Models\Dokter::where('status', 'aktif')
                                    ->select('spesialis')
                                    ->distinct()
                                    ->pluck('spesialis');
                            @endphp
                            @foreach($spesialisList as $spesialis)
                                <button type="button" 
                                        class="filter-spesialis px-3 py-1.5 bg-gray-200 text-gray-600 rounded-lg text-xs font-semibold transition hover:bg-gray-300"
                                        data-spesialis="{{ $spesialis }}">
                                    {{ ucfirst($spesialis) }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                    
                    {{-- Active Filters --}}
                    <div id="activeFilters" class="flex flex-wrap items-center gap-2 mt-3 hidden">
                        <span class="text-xs font-medium text-gray-500">Filter aktif:</span>
                        <span id="filterSearchBadge" class="hidden inline-flex items-center gap-1 bg-blue-50 text-blue-700 text-xs px-3 py-1 rounded-full border border-blue-200">
                            <i class="fas fa-search"></i> "<span id="filterSearchText"></span>"
                            <button type="button" onclick="clearSearch()" class="ml-1 hover:text-blue-900">
                                <i class="fas fa-times-circle"></i>
                            </button>
                        </span>
                        <span id="filterSpesialisBadge" class="hidden inline-flex items-center gap-1 bg-blue-50 text-blue-700 text-xs px-3 py-1 rounded-full border border-blue-200">
                            <i class="fas fa-user-md"></i> <span id="filterSpesialisText"></span>
                            <button type="button" onclick="clearSpesialis()" class="ml-1 hover:text-blue-900">
                                <i class="fas fa-times-circle"></i>
                            </button>
                        </span>
                        <button type="button" onclick="resetAllFilters()" class="text-xs text-red-400 hover:text-red-600 font-medium">
                            <i class="fas fa-undo mr-1"></i> Reset semua
                        </button>
                    </div>
                </div>

                {{-- Result Count --}}
                <p class="text-xs text-gray-400 mb-3">
                    <span id="dokterCount">{{ $dokters->count() }}</span> dokter tersedia
                </p>
                
                {{-- DOKTER GRID - 4 KOLOM DI DESKTOP --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-4" id="dokterGrid">
                    @foreach($dokters as $dokter)
                    @php
                    /** @var \App\Models\Dokter $dokter */
                    $dokterId = $dokter->id;
                    @endphp
                    <div class="dokter-card border-2 rounded-xl p-4 cursor-pointer transition-all hover:shadow-lg hover:border-blue-400 {{ old('dokter_id') == $dokterId ? 'border-blue-500 bg-blue-50 shadow-md' : 'border-gray-200 bg-white' }}"
                         data-dokter-id="{{ $dokterId }}"
                         data-nama="{{ strtolower($dokter->user->nama) }}"
                         data-spesialis="{{ strtolower($dokter->spesialis) }}"
                         onclick="selectDokter({{ $dokterId }})">
                        <div class="flex flex-col items-center text-center">
                            <img src="{{ $dokter->foto_url }}" 
                                 alt="{{ $dokter->user->nama }}" 
                                 class="w-20 h-20 rounded-full object-cover border-2 {{ old('dokter_id') == $dokterId ? 'border-blue-500' : 'border-gray-200' }} mb-3">
                            <h4 class="font-semibold text-gray-800 text-sm">{{ $dokter->user->nama }}</h4>
                            <p class="text-xs text-blue-500">{{ ucfirst($dokter->spesialis) }}</p>
                            <div class="mt-2">
                                <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-xs">
                                    <i class="fas fa-check-circle mr-1"></i> Aktif
                                </span>
                            </div>
                            <div class="mt-1 text-xs font-bold text-green-600">
                                Rp {{ number_format($dokter->tarif ?? 50000, 0, ',', '.') }}
                            </div>
                            <p class="text-xs text-gray-400 mt-1">
                                <i class="fas fa-phone mr-1"></i> {{ $dokter->user->nomor_hp ?? '-' }}
                            </p>
                        </div>
                        <input type="radio" name="dokter_id" value="{{ $dokterId }}" 
                               class="hidden dokter-radio" 
                               {{ old('dokter_id') == $dokterId ? 'checked' : '' }}
                               data-dokter-id="{{ $dokterId }}">
                    </div>
                    @endforeach
                </div>
                @error('dokter_id')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-400 mt-2">Klik salah satu kartu dokter di atas untuk memilih</p>
            </div>

            {{-- STEP 2: Informasi Dokter Terpilih --}}
            <div id="dokterInfo" class="hidden bg-blue-50 rounded-xl p-5 border border-blue-200">
                <div class="flex items-center gap-4">
                    <img id="selectedDokterFoto" src="" alt="" class="w-16 h-16 rounded-full object-cover border-2 border-blue-300">
                    <div>
                        <h4 id="selectedDokterNama" class="font-semibold text-gray-800"></h4>
                        <p id="selectedDokterSpesialis" class="text-sm text-blue-500"></p>
                        <p id="selectedDokterHp" class="text-xs text-gray-500"><i class="fas fa-phone mr-1"></i> </p>
                        <p id="selectedDokterTarif" class="text-sm font-bold text-green-600 mt-1"></p>
                    </div>
                </div>
            </div>

            {{-- STEP 3: Pilih Jadwal --}}
            <div id="jadwalSection" class="hidden">
                <div class="border-t border-gray-200 pt-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar-alt text-blue-500 mr-1"></i> Pilih Jadwal <span class="text-red-500">*</span>
                    </label>
                    <select name="jadwal_id" id="jadwal_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('jadwal_id') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih dokter dahulu --</option>
                    </select>
                    @error('jadwal_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <div id="loading-jadwal" class="hidden mt-2 flex items-center gap-2 text-blue-500 text-sm">
                        <i class="fas fa-spinner fa-spin"></i> Memuat jadwal...
                    </div>
                    <p id="jadwal-info" class="text-xs text-gray-400 mt-1">Jadwal akan muncul setelah memilih dokter</p>
                </div>
            </div>

            {{-- STEP 4: Keluhan --}}
            <div id="keluhanSection" class="hidden">
                <div class="border-t border-gray-200 pt-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-comment-medical text-blue-500 mr-1"></i> Keluhan <span class="text-red-500">*</span>
                    </label>
                    <textarea name="keluhan" id="keluhan" rows="4" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('keluhan') border-red-500 @enderror"
                        placeholder="Jelaskan keluhan Anda secara detail (minimal 10 karakter)..."
                        required>{{ old('keluhan') }}</textarea>
                    @error('keluhan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <div class="flex justify-between items-center mt-1">
                        <p class="text-xs text-gray-400">Jelaskan keluhan Anda dengan detail</p>
                        <span class="text-xs text-gray-400"><span id="charCount">0</span>/500</span>
                    </div>
                </div>
            </div>

            {{-- Tombol Submit --}}
            <div id="submitSection" class="hidden">
                <button type="submit" id="submitBtn" class="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white py-4 rounded-xl font-semibold transition duration-200 shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                    <i class="fas fa-calendar-check"></i> Buat Janji Temu
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    // ============ SEARCH & FILTER ============
    var searchInput = document.getElementById('searchDokter');
    var filterButtons = document.querySelectorAll('.filter-spesialis');
    var dokterCards = document.querySelectorAll('.dokter-card');
    var dokterCount = document.getElementById('dokterCount');
    var activeFiltersDiv = document.getElementById('activeFilters');
    var filterSearchBadge = document.getElementById('filterSearchBadge');
    var filterSearchText = document.getElementById('filterSearchText');
    var filterSpesialisBadge = document.getElementById('filterSpesialisBadge');
    var filterSpesialisText = document.getElementById('filterSpesialisText');

    var currentSearch = '';
    var currentSpesialis = '';

    function filterDokter() {
        var search = currentSearch.toLowerCase().trim();
        var spesialis = currentSpesialis.toLowerCase().trim();
        var visibleCount = 0;

        dokterCards.forEach(function(card) {
            var nama = card.getAttribute('data-nama') || '';
            var cardSpesialis = card.getAttribute('data-spesialis') || '';
            
            var matchSearch = true;
            var matchSpesialis = true;
            
            if (search) {
                matchSearch = nama.includes(search) || cardSpesialis.includes(search);
            }
            
            if (spesialis) {
                matchSpesialis = cardSpesialis === spesialis;
            }
            
            if (matchSearch && matchSpesialis) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        dokterCount.textContent = visibleCount;

        // Update active filters
        var hasFilters = search || spesialis;
        if (hasFilters) {
            activeFiltersDiv.classList.remove('hidden');
        } else {
            activeFiltersDiv.classList.add('hidden');
        }

        // Update search badge
        if (search) {
            filterSearchBadge.classList.remove('hidden');
            filterSearchText.textContent = search;
        } else {
            filterSearchBadge.classList.add('hidden');
        }

        // Update spesialis badge
        if (spesialis) {
            filterSpesialisBadge.classList.remove('hidden');
            filterSpesialisText.textContent = spesialis;
        } else {
            filterSpesialisBadge.classList.add('hidden');
        }
    }

    // Search input
    searchInput.addEventListener('input', function() {
        currentSearch = this.value;
        filterDokter();
    });

    // Filter buttons
    filterButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var spesialis = this.getAttribute('data-spesialis');
            
            // Reset all filter buttons
            filterButtons.forEach(function(b) {
                b.classList.remove('bg-blue-500', 'text-white');
                b.classList.add('bg-gray-200', 'text-gray-600');
            });
            
            if (spesialis === '') {
                // Semua
                this.classList.remove('bg-gray-200', 'text-gray-600');
                this.classList.add('bg-blue-500', 'text-white');
                currentSpesialis = '';
            } else {
                this.classList.remove('bg-gray-200', 'text-gray-600');
                this.classList.add('bg-blue-500', 'text-white');
                currentSpesialis = spesialis;
            }
            
            filterDokter();
        });
    });

    function clearSearch() {
        searchInput.value = '';
        currentSearch = '';
        filterDokter();
    }

    function clearSpesialis() {
        currentSpesialis = '';
        filterButtons.forEach(function(b) {
            b.classList.remove('bg-blue-500', 'text-white');
            b.classList.add('bg-gray-200', 'text-gray-600');
        });
        // Set "Semua" aktif
        document.querySelector('.filter-spesialis[data-spesialis=""]').classList.remove('bg-gray-200', 'text-gray-600');
        document.querySelector('.filter-spesialis[data-spesialis=""]').classList.add('bg-blue-500', 'text-white');
        filterDokter();
    }

    function resetAllFilters() {
        searchInput.value = '';
        currentSearch = '';
        currentSpesialis = '';
        filterButtons.forEach(function(b) {
            b.classList.remove('bg-blue-500', 'text-white');
            b.classList.add('bg-gray-200', 'text-gray-600');
        });
        document.querySelector('.filter-spesialis[data-spesialis=""]').classList.remove('bg-gray-200', 'text-gray-600');
        document.querySelector('.filter-spesialis[data-spesialis=""]').classList.add('bg-blue-500', 'text-white');
        filterDokter();
    }

    // ============ SELECT DOKTER ============
    var dokterData = {!! json_encode($dokters->map(function($d) {
        /** @var \App\Models\Dokter $d */
        return [
            'id' => $d->id,
            'nama' => $d->user->nama,
            'spesialis' => $d->spesialis,
            'foto' => $d->foto_url,
            'nomor_hp' => $d->user->nomor_hp ?? '-',
            'tarif' => 'Rp ' . number_format($d->tarif ?? 50000, 0, ',', '.'),
        ];
    })) !!};

    function selectDokter(dokterId) {
        // Update radio button
        document.querySelectorAll('.dokter-radio').forEach(function(el) {
            el.checked = el.getAttribute('data-dokter-id') == dokterId;
        });
        
        // Update card style
        document.querySelectorAll('.dokter-card').forEach(function(el) {
            el.classList.remove('border-blue-500', 'bg-blue-50', 'shadow-md');
            el.classList.add('border-gray-200', 'bg-white');
            if (el.getAttribute('data-dokter-id') == dokterId) {
                el.classList.remove('border-gray-200', 'bg-white');
                el.classList.add('border-blue-500', 'bg-blue-50', 'shadow-md');
            }
        });
        
        // Tampilkan info dokter
        var dokter = null;
        for (var i = 0; i < dokterData.length; i++) {
            if (dokterData[i].id == dokterId) {
                dokter = dokterData[i];
                break;
            }
        }
        
        if (dokter) {
            document.getElementById('selectedDokterFoto').src = dokter.foto;
            document.getElementById('selectedDokterNama').textContent = dokter.nama;
            document.getElementById('selectedDokterSpesialis').textContent = dokter.spesialis;
            document.getElementById('selectedDokterHp').innerHTML = '<i class="fas fa-phone mr-1"></i> ' + dokter.nomor_hp;
            document.getElementById('selectedDokterTarif').innerHTML = '<i class="fas fa-money-bill-wave mr-1"></i> ' + dokter.tarif;
            document.getElementById('dokterInfo').classList.remove('hidden');
            document.getElementById('jadwalSection').classList.remove('hidden');
            
            // Load jadwal
            loadJadwal(dokterId);
        }
    }

    // Load jadwal
    function loadJadwal(dokterId) {
        var jadwalSelect = document.getElementById('jadwal_id');
        var loadingText = document.getElementById('loading-jadwal');
        var jadwalInfo = document.getElementById('jadwal-info');

        jadwalSelect.innerHTML = '<option value="">-- Pilih Jadwal --</option>';
        jadwalInfo.textContent = 'Memuat jadwal...';
        loadingText.classList.remove('hidden');

        fetch('{{ route("pasien.reservasi.jadwal") }}?dokter_id=' + dokterId)
            .then(function(response) { return response.json(); })
            .then(function(jadwals) {
                loadingText.classList.add('hidden');
                
                if (!jadwals || jadwals.length === 0) {
                    jadwalSelect.innerHTML = '<option value="">Tidak ada jadwal tersedia</option>';
                    jadwalInfo.textContent = 'Tidak ada jadwal untuk dokter ini';
                    return;
                }

                jadwalInfo.textContent = jadwals.length + ' jadwal tersedia';
                for (var i = 0; i < jadwals.length; i++) {
                    var jadwal = jadwals[i];
                    var tanggal = new Date(jadwal.tanggal).toLocaleDateString('id-ID', {
                        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
                    });
                    var option = document.createElement('option');
                    option.value = jadwal.id;
                    option.textContent = tanggal + ' | ' + jadwal.jam_mulai + ' - ' + jadwal.jam_selesai + ' (Sisa: ' + jadwal.sisa_kuota + ' slot)';
                    jadwalSelect.appendChild(option);
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
                loadingText.classList.add('hidden');
                jadwalSelect.innerHTML = '<option value="">Gagal memuat jadwal</option>';
                jadwalInfo.textContent = 'Terjadi kesalahan saat memuat jadwal';
            });
    }

    // Event listener untuk jadwal (munculkan keluhan)
    document.getElementById('jadwal_id').addEventListener('change', function() {
        var keluhanSection = document.getElementById('keluhanSection');
        var submitSection = document.getElementById('submitSection');
        
        if (this.value) {
            keluhanSection.classList.remove('hidden');
            submitSection.classList.remove('hidden');
        } else {
            keluhanSection.classList.add('hidden');
            submitSection.classList.add('hidden');
        }
    });

    // Counter karakter keluhan
    document.getElementById('keluhan').addEventListener('input', function() {
        var count = this.value.length;
        document.getElementById('charCount').textContent = count;
    });

    // Auto-select dokter jika ada old value
    document.addEventListener('DOMContentLoaded', function() {
        var checkedRadio = document.querySelector('.dokter-radio:checked');
        if (checkedRadio) {
            selectDokter(checkedRadio.value);
        }
        
        // Trigger jadwal change jika ada old value
        var jadwalSelect = document.getElementById('jadwal_id');
        if (jadwalSelect.value) {
            document.getElementById('keluhanSection').classList.remove('hidden');
            document.getElementById('submitSection').classList.remove('hidden');
        }

        // Set "Semua" filter aktif
        document.querySelector('.filter-spesialis[data-spesialis=""]').classList.remove('bg-gray-200', 'text-gray-600');
        document.querySelector('.filter-spesialis[data-spesialis=""]').classList.add('bg-blue-500', 'text-white');
    });
</script>