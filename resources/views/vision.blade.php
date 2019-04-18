@extends('layout.base')

@section('body')
    <div class="container">
        <div class="row">
            <div class="card-item-outer col-6">
                <div class="card-item">
                    <h2 class=title>HBO-I Job Event</h2>
                    <p class=content>
                        Bij de bedrijven met welke ik gesproken heb, worden meerdere culturen gebruikt. Zo wordt bij Accenture gewerkt in projectgroepen,
                        deze project groepen zijn iedere keer anders. Bij dongIT en Secura BV, welke pentesting bedrijven zijn, wordt natuurlijk op een heel andere manier
                        gedacht. Hierbij wordt voornamelijk gekeken naar <i>hoe</i> een werkend programma/applicatie gebroken kan worden door een mogelijke hacker.
                        Bij de Sligro wordt veel geoutsourced op dit moment, dat betekent dat er toch meer een management cultuur hangt.
                        <br><br>
                        Er zijn vele functies binnen de bedrijven. Bij Quintor zijn de meeste posities full-stack developers, terwijl bij Accenture de posities opgesplitst zijn
                        in front-end, back-end, management, consulting, etc. Bij de pentesting bedrijven, dongIT en Secura BV, is de belangrijkste positie een pentester, maar ook zijn er een aantal posities die meer
                        met de mensen omgaan, social engineering posities.
                        <br>
                        Ook zijn er vele bedrijven die server beheer posities hebben; de lieden die het bedrijf werkelijk in werking houden.
                        <br><br>
                        Ten slotte zijn er ook vele manier van werken in de verschillende bedrijven. Zoals eerder genoemd, werkt de Sligro met out-sourcing, zelf doen ze dus niet zo heel veel, maar ze laten andere
                        bedrijven het werk doen. Een aantal bedrijven werken met de Agile methode, hierbij dan ook Scrum; deze bedrijven zijn bijvoorbeel Quintor of Accenture.
                    </p>
                </div>
            </div>
            <div class="card-item-outer col-6">
                <div class="card-item">
                    <h2 class=title>Bedrijvensafari</h2>
                    <p class=content>
                        Bij de bedrijvensafari op 11 oktober ben ik langsgeweest bij Syntess, Omoda, Your Surprise, ZLM en Soltegro.
                        <br>
                        Veel dingen van het Job Event kwamen hier ook weer terug. Zo werkt Syntess met Agile/Scrum. De ZLM werkte met de waterval methode, maar wisselt ook over naar Agile.
                        <br>
                        De culturen binnen de bedrijven variëren wel behoorlijk. Zo is Your Surprise een bedrijf dat enorm aan het uitbreiden is; wat over aan het gaan is van klein naar groot bedrijf.
                        <img src="{{ asset('images/omoda.jpg') }}">
                        Op 19 december bedrijfsbezoek aan Elloro/Recranet, Damen en Conneqtech te Vlissingen.
                        <br>
                        Deze bedrijven hebben we bezocht om een <i>real life</i> implementatie te kunnen zien van een aantal van de technieken die we nu in de lessen leren.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
