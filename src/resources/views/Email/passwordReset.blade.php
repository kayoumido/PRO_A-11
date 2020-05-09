@component('mail::message')
# Récupération de mot de passe

Vous avez fait une demande de récupération de mot de passe, pour réinitialiser votre mot de passe veuillez cliquer sur le bouton ci-dessous.

@component('mail::button', ['url' => config('app.url') . '/reset-password/' . $token])
Réinitialiser mdp
@endcomponent

Si vous n'êtes pas à l'origine de cette demande merci de nous contacter au plus vite.

Merci d'utiliser nos services,<br>
{{ config('app.name') }}
@endcomponent
