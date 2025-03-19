@extends('template.master')

@section('content')
<div class="container mt-2">
  <div class="card">
      <div class="card-header d-flex justify-content-between">
          <h4>Album</h4>
          <a href="{{ route('album.download') }}" type="button" class="btn">
              <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                  <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path stroke-dasharray="20" stroke-dashoffset="20" d="M12 4h2v6h2.5l-4.5 4.5M12 4h-2v6h-2.5l4.5 4.5">
                          <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="20;0" />
                      </path>
                      <path stroke-dasharray="14" stroke-dashoffset="14" d="M6 19h12">
                          <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.5s" dur="0.2s" values="14;0" />
                      </path>
                  </g>
              </svg>
          </a>
      </div>
            <div class="card-body">
                <div class="mb-4 album-tabs">
                    <ul class="nav nav-tabs" id="albumTabs" role="tablist">
                        @foreach ($album as $key => $item)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $key === 0 ? 'active' : '' }}" 
                                    id="tab-{{ $item->id }}" 
                                    data-bs-toggle="tab" 
                                    data-bs-target="#album-{{ $item->id }}" 
                                    type="button" 
                                    role="tab" 
                                    aria-controls="album-{{ $item->id }}" 
                                    aria-selected="{{ $key === 0 ? 'true' : 'false' }}">
                                    {{ $item->album }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="tab-content" id="albumTabContent">
                    @foreach ($album as $key => $item)
                        <div class="tab-pane fade {{ $key === 0 ? 'show active' : '' }}" 
                            id="album-{{ $item->id }}" 
                            role="tabpanel" 
                            aria-labelledby="tab-{{ $item->id }}">
                            
                            <div class="mb-3 album-subtitle">
                                <h5>{{ $item->album }}</h5>
                            </div>
                            
                            <div class="row g-3">
                                @foreach ($item->fotos as $itemfoto)
                                    <div class="col-md-4 col-sm-6">
                                        <div class="photo-card">
                                            <img src="{{ asset('storage/images/' . $itemfoto->foto) }}"
                                                class="rounded shadow-sm img-fluid" alt="Album photo">
                                            <div class="photo-overlay">
                                                <div class="overlay-actions">
                                                    <button class="btn btn-sm btn-light view-photo" 
                                                        data-src="{{ asset('storage/images/' . $itemfoto->foto) }}">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Photo preview modal -->
    <div class="modal fade" id="photoPreviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="border-0 modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="p-0 text-center modal-body">
                    <img src="" id="previewImage" class="img-fluid" alt="Preview">
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Dark mode compatibility */
        .album-title,
        .album-subtitle h5 {
            color: var(--bs-body-color, #212529);
        }
        
        .btn-download {
            color: var(--bs-body-color, #212529);
            background-color: rgba(var(--bs-secondary-rgb, 108, 117, 125), 0.1);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        
        .btn-download:hover {
            background-color: rgba(var(--bs-secondary-rgb, 108, 117, 125), 0.2);
        }
        
        .album-tabs .nav-link {
            color: var(--bs-body-color, #495057);
            border-radius: 0;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }
        
        .album-tabs .nav-link:hover {
            background-color: rgba(var(--bs-body-bg-rgb, 248, 249, 250), 0.5);
        }
        
        .album-tabs .nav-link.active {
            color: var(--bs-primary, #0d6efd);
            font-weight: 500;
            background-color: var(--bs-body-bg, #fff);
            border-bottom: 2px solid var(--bs-primary, #0d6efd);
        }
        
        .photo-card {
            position: relative;
            overflow: hidden;
            border-radius: 5px;
            transition: transform 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .photo-card:hover {
            transform: translateY(-5px);
        }
        
        .photo-card img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }
        
        .photo-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .photo-card:hover .photo-overlay {
            opacity: 1;
        }
        
        .overlay-actions {
            display: flex;
            gap: 10px;
        }
        
        .overlay-actions .btn {
            color: #212529;
            background-color: #fff;
        }
        
        .tab-content {
            padding: 15px 0;
        }
        
        /* Dark mode overrides */
        @media (prefers-color-scheme: dark) {
            .card {
                background-color: var(--bs-dark, #212529);
                border-color: var(--bs-dark-border-subtle, #495057);
            }
            
            .card-header {
                background-color: rgba(255, 255, 255, 0.05);
                border-color: var(--bs-dark-border-subtle, #495057);
            }
            
            .album-title,
            .album-subtitle h5 {
                color: var(--bs-light, #f8f9fa);
            }
            
            .btn-download {
                color: var(--bs-light, #f8f9fa);
                background-color: rgba(255, 255, 255, 0.1);
            }
            
            .btn-download:hover {
                background-color: rgba(255, 255, 255, 0.2);
            }
            
            .album-tabs .nav-link {
                color: var(--bs-light, #f8f9fa);
                border-color: var(--bs-dark-border-subtle, #495057);
            }
            
            .album-tabs .nav-link:hover {
                background-color: rgba(255, 255, 255, 0.05);
            }
            
            .album-tabs .nav-link.active {
                color: var(--bs-primary, #0d6efd);
                background-color: var(--bs-dark, #212529);
            }
            
            .modal-content {
                background-color: var(--bs-dark, #212529);
                border-color: var(--bs-dark-border-subtle, #495057);
            }
            
            .btn-close {
                filter: invert(1) grayscale(100%) brightness(200%);
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize photo preview modal
            const photoPreviewModal = new bootstrap.Modal(document.getElementById('photoPreviewModal'));
            
            // Setup event listeners for photo view buttons
            document.querySelectorAll('.view-photo').forEach(button => {
                button.addEventListener('click', function() {
                    const imgSrc = this.getAttribute('data-src');
                    document.getElementById('previewImage').src = imgSrc;
                    photoPreviewModal.show();
                });
            });
        });
    </script>
@endsection