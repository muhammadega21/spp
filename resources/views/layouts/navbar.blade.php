<div class="container-fluid">
    <div class="row">
        <div class="nav">
            <div class="left d-flex align-items-center">
                <div class="bars">
                    <i class="fa-solid fa-bars text-light" id="bar"></i>
                </div>
                <div class="title ms-3">
                    <span style="font-size: 20px;"><a href="/dashboard" class="text-black">WebSPP</a></span>
                </div>
            </div>
            
            @if ( auth()->user()->level != 3)
            <div class="right d-flex align-items-center">
                <div class="user-name">
                   {{ auth()->user()->petugas->username }}
                </div>
                <div class="user mx-3">
                   <div class="user-profiles">
                    @if (auth()->user()->petugas->image == 'user.png')
                    <img src="{{ url('img/'.auth()->user()->petugas->image) }}" alt="{{ auth()->user()->petugas->username }}" style="cursor: pointer" id="user-profile">
                    @else
                    <img src="{{ url(asset('storage/' . auth()->user()->petugas->image)) }}" alt="{{ auth()->user()->petugas->username }}" style="cursor: pointer" id="user-profile">
                    @endif
                   </div>
                   <div class="user-info">
                       <div class="top mx-3">
                               <div class="user-image mb-2">
                                @if (auth()->user()->petugas->image == 'user.png')
                                <img src="{{ url('img/'.auth()->user()->petugas->image) }}" alt="{{ auth()->user()->petugas->username }}">
                                @else
                                <img src="{{ url(asset('storage/' .auth()->user()->petugas->image)) }}" alt="{{ auth()->user()->petugas->username }}">
                                @endif
                               </div>
                               <span class="d-block">{{ auth()->user()->petugas->name }}</span>
                       </div>
                       <div class="border border-bottom-1 mx-3 my-2"></div>
                       <div class="bottom">
                               <a href=""><i class="fa-solid fa-user-pen edit-profile bg-warning"></i></a>
                               <a href="/logout"><i class="fa-solid fa-right-from-bracket logout bg-danger"></i></a>
                       </div>
                   </div>
                </div>
            </div>
            @else
            <div class="right d-flex align-items-center">
                <div class="user-name">
                   {{ auth()->user()->siswa->username }}
                </div>
                <div class="user mx-3">
                   <div class="user-profiles">
                    @if (auth()->user()->siswa->image == 'user.png')
                    <img src="{{ url('img/'.auth()->user()->siswa->image) }}" alt="{{ auth()->user()->siswa->username }}" style="cursor: pointer" id="user-profile">
                    @else
                    <img src="{{ url(asset('storage/' . auth()->user()->siswa->image)) }}" alt="{{ auth()->user()->siswa->username }}" style="cursor: pointer" id="user-profile">
                    @endif
                   </div>
                   <div class="user-info">
                       <div class="top mx-3">
                               <div class="user-image mb-2">
                                @if (auth()->user()->siswa->image == 'user.png')
                                <img src="{{ url('img/'.auth()->user()->siswa->image) }}" alt="{{ auth()->user()->siswa->username }}">
                                @else
                                <img src="{{ url(asset('storage/' .auth()->user()->siswa->image)) }}" alt="{{ auth()->user()->siswa->username }}">
                                @endif
                               </div>
                               <span class="d-block">{{ auth()->user()->siswa->name }}</span>
                       </div>
                       <div class="border border-bottom-1 mx-3 my-2"></div>
                       <div class="bottom">
                               <a href=""><i class="fa-solid fa-user-pen edit-profile bg-warning"></i></a>
                               <a href="/logout"><i class="fa-solid fa-right-from-bracket logout bg-danger"></i></a>
                       </div>
                   </div>
                </div>
            </div>
            @endif
            
        </div>
    </div>
</div>