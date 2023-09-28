<?php
return [

    /**
     * You can generate API keys here: https://cloudconvert.com/dashboard/api/v2/keys.
     */

    'api_key' => env('CLOUDCONVERT_API_KEY', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZmEyOWUxOWZiNWVjZDE0ZTNhNzcyZDVhMWUyMDUyODhjZWVkNTljNGU4NTg0YWQ0ZWVkM2M4MmJmZDE1MTZjYjFlNzZkODlhYzczYTM4NGMiLCJpYXQiOjE2NjM0MjEyODIuMDk2NzYxLCJuYmYiOjE2NjM0MjEyODIuMDk2NzYzLCJleHAiOjQ4MTkwOTQ4ODIuMDkxNTI2LCJzdWIiOiI1OTgzMzI2MSIsInNjb3BlcyI6WyJ1c2VyLnJlYWQiLCJ1c2VyLndyaXRlIiwidGFzay5yZWFkIiwidGFzay53cml0ZSIsIndlYmhvb2sucmVhZCIsIndlYmhvb2sud3JpdGUiLCJwcmVzZXQucmVhZCIsInByZXNldC53cml0ZSJdfQ.aL9znmYJB8J5T832wVprHa-9U8p4Eb7TaS8dhl8T9dp1lbLAwgZA4qvOsk8fdCpyVmfgwzDgnNTGUo4fv786E090A29Jb4Ts69tonfFqlHHBzz32g4G6Zaz3KW0yYiiTncCrr-Q1_fT1lirE6rgKr4AMOtxm6aol_2fwK7EYwIKpm10BWcBHmqcpRtPCeny_lMURQa9V_2InTmk1U2XvAkJlvYANa2ELv9HiWqpBQPoq5nvlWVFKF0pY-Fk3UJpjgOIJiaeHK7Hm2pa3qAdFLSYQ1_KO1Xcx4H8IlAwu0im0J0BksRs5fituXh7Z6uZfVv13OlnT09nmYzs18YAufWc1YJkMioNBGq5MQmKUnj1uAehgjshz8oWJjz4SzfEcJ-uL4ncCkBLSxCs-_K4ZByqo-x39j3wsd-UzvjDPJ_CrF1-8XutihF5b8Vm-l1JIIM5U593emi41AKMaTKuGhDlhdnWEaLVtEJsr_K-FbAP97YHJRwfukBuWdC8V4koqsBxzIGdh4oGsU2n68eMGx4A1LFk7v6CGjyobd3k8NpriRgoRYUC3QPbeNuIcP4Cw59yaD9lsk2ih2YdYxvMkpH2S8l10pJZKdNZ0QGLQn2JBT-zgVHI8aPl460NSlUQU7HkLCbpN7PW1xhg7CHTMAStJNJokSqQ3paG9sBjakbs'),

    /**
     * Use the CloudConvert Sanbox API (Defaults to false, which enables the Production API).
     */
    'sandbox' => env('CLOUDCONVERT_SANDBOX', false),

    /**
     * You can find the secret used at the webhook settings: https://cloudconvert.com/dashboard/api/v2/webhooks
     */
    'webhook_signing_secret' => env('CLOUDCONVERT_WEBHOOK_SIGNING_SECRET', '')

];
