import boto3

def lambda_handler(event, context):
    # Extract relevant information from the DynamoDB trigger event
    user_email = event['Records'][0]['dynamodb']['NewImage']['Email']['S']
    # ... Extract any other necessary information ...

    # Create an SES client
    ses = boto3.client('ses')

    # Send an email to the new subscriber
    response = ses.send_email(
        Source='',  # Replace with your verified email address
        Destination={
            'ToAddresses': [user_email]
        },
        Message={
            'Subject': {
                'Data': 'Welcome to Our Service'
            },
            'Body': {
                'Text': {
                    'Data': 'Thank you for filling out the form. Welcome to the Gold Grid family.!'
                }
            }
        }
    )

    return 'Email sent successfully: ' + response['MessageId']

