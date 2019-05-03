@extends('layout.base')

@section('body')
    <div class="container">
        <div class="row">
            <div class="card-item-outer col-6">
                <div class="card-item">
                    <h2 class="title">Over mij</h2>
                    <div class="content">
                        <p>Ik ben Daniel de Cloet <span id="leeftijd">18</span> jaar oud. Ik ben geboren in Arnhem, maar kort daarna verhuist naar Zeeland. Ik woon nog altijd in de buurt, namelijk in Biggekerke.<br>Ik ben een ware <i>IT-enthousiastic</i>. Om wat verduidelijking the geven:<br>Ik doe veel in mijn vrije tijd in het veld. Samen met een grote groep vrienden, grotendeels afkomstig uit de VS, werk ik veel in het DevOps veld. Ik onderhoud veel game servers, onder andere MineCraft, Space Engineers and ARK: Survival Evolved. Recentelijk zijn we ook begonnen met web development. Natuurlijk zijn dit voornamelijk persoonlijke projecten.</p>
                    </div>
                </div>
            </div>
            <div class="card-item-outer col-6">
                <div class="card-item">
                    <h2 class="title">Hobbies</h2>
                    <ul class="content">
                        <li>Muziek - Trompet
                            <ul>
                                <li>Fanfare Luctor et Emergo, Zoutelande</li>
                            </ul>
                        </li>
                        <li>Gamen
                            <ul>
                                <li>Internationale Vriendengroep
                                    <ul>
                                        <li>GTA Online</li>
                                        <li>Diablo III</li>
                                        <li>Elite Dangerous</li>
                                        <li>Overwatch</li>
                                        <li>D&#38;D</li>
                                    </ul>
                                </li>
                                <li>Singleplayer
                                    <ul>
                                        <li>Citites: Skylines</li>
                                        <li>Factorio</li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>DevOps
                            <ul>
                                <li>Game Servers</li>
                                <li>Web Servers</li>
                                <li>IRC Servers</li>
                                <li>Discord Bots</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card-item-outer col-12">
                <div class="card-item">
                    <h2 class="title">Foto's</h2>
                    <div class="content content-image">
                        <img class="col-6" alt="Afbeelding Muziek" title="Afbeelding Muziek" src="{{ asset('images/muziek.jpg') }}">
                        <img class="col-6" alt="Afbeelding Paarden" title="Afbeelding Paarden" src="{{ asset('images/paardjes.jpg') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
