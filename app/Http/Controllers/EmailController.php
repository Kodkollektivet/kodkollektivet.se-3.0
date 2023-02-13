<?php

namespace App\Http\Controllers;
use App\Models\User;


class EmailController extends Controller
{
    public static $headers = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\nFrom: welcome@kodkollektivet.se\r\nX-Mailer: PHP/";

    public function verify(string $email)
    {
        $domain    = substr(strrchr($email, "@"), 1);
        $mxrecords = array();

        getmxrr($domain, $mxrecords);

        if (strpos($email, '@lnu.se') || strpos($email, '@gmail.com'))
        {
            $email  = str_replace('@lnu.se', '@student.lnu.se', $email);
            // $record = 'smtp.google.com';
        }
        // else
        // {
        //     $record = $mxrecords[0];
        // }

        return count($mxrecords) ? $email : (checkdnsrr($domain) ? $email : EmailController::throwNotFound());

        // return isset($mxrecords) && count($mxrecords) ? EmailController::verifyTelnet($email, $record) : (checkdnsrr($domain) ? $email : EmailController::throwNotFound());
    }

    public static function sendVerificationEmail(string $email, string $key)
    {
        mail($email, '✨ Welcome to Kodkollektivet! ✨', "We are glad to have you! To verify your email and access the 
                      website\'s functionality, follow this <a href='www.kodkollektivet.se/verify-user/$key'>link</a>.", static::$headers . phpversion());

        return response()->json(['message' => "Sent verification email to $email 👍"]);
    }

    public static function sendCompanyNotification(User $user)
    {
        mail($user->email, '✨ Welcome to Kodkollektivet! ✨', "We are glad to have you! You will be able to access full website functionality once your account
                         gets verified by an admin.", static::$headers . phpversion());

        mail('office@kodkollektivet.se', '✨ Kodkollektivet: company access ✨', "User <a href='www.kodkollektivet.se/member/{$user->username}'>{$user->username}</a>
                                             requested company access.", static::$headers . phpversion());

        return response()->json(['message' => "Sent welcome email to $email 👍 We will review your request ASAP!"]);
    }

    public static function sendCompanyVerification(User $user)
    {
        mail($user->email, '✨ Kodkollektivet: company access granted ✨', "Thank you for expressing your interest in working with us; we are excited for what's to come!
                                                                            You have been granted company access to the system, allowing you to create posts and events,
                                                                            as well as to finish setting your <a href='www.kodkollektivet.se/member/{$user->username}'>profile</a> up!",
                                                                            static::$headers . phpversion());
    }
    
    public static function invite(User $user, \Illuminate\Http\Request $request)
    {
        if (!in_array($user->role_id, [4, 5]))
        {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:50', 'min:9', 'unique:users', 'unique:invites,sent_to'],
            ]);

            $email = EmailController::verify($request->email);

            EmailController::sendInvite($user, $email);
            \App\Models\Invite::create(['user_id' => $user->id, 'sent_to' => $email]);

            return response()->json(['message' => "Invitation sent to $email! You will be notified once they sign up 😉"], 200);
        }

        return response()->json(['message' => $user->role_id == 4 ? 'Verify your own email to invite others!' : 'Banned users cannot send invitations.'], 403);
    }

    private static function sendInvite(User $user, string $email)
    {
        mail($email, '💻 Kodkollektivet.se: Invitation to join', "Hej! Looks like $user->name (aka <a href='www.kodkollektivet.se/member/{$user->username}'>$user->username</a>) has invited you to join Kodkollektivet ✨\n\t
                      Use this ($email) email address to <a href='www.kodkollektivet.se/register'>register</a>, or ask your friend to send a new invite to a different mailbox.\n\r\n\r
                      Looking forward to seeing you join our ranks 😉", static::$headers . phpversion());
    }

    public static function sendInviteAccepted(User $sender, User $recepient)
    {
        mail($sender->email, '💻 Kodkollektivet.se: Invitation accepted', "Hej! User $recepient->name (aka <a href='www.kodkollektivet.se/member/{$recepient->username}'>$recepient->username</a>)
                              has accepted your invitation! Come and help them set their profile up 🙂", static::$headers . phpversion());
    }

    // Google is a stupid bitch; this shall remain sitted here until the Second Coming.
    // private function verifyTelnet(string $email, string $server)
    // {
    //     $telnet   = ['', "helo hi\r\n", "MAIL FROM: <>\r\n", "RCPT TO:<$email>\r\n"];
    //     $socket   = fsockopen($server, 25);
    //     $response = array();

    //     foreach ($telnet as $line)
    //     {
    //         fputs($socket, $line);
    //         sleep(1);
    //         array_push($response, fgets($socket));
    //     }

    //     fclose($socket);

    //     return strpos($response[3], '250 2.1.5') !== false ? $email : EmailController::throwNotFound();
    // }

    private function throwNotFound()
    {
        throw \Illuminate\Validation\ValidationException::withMessages(['email' => 'Email not found on server.']);
    }

}
