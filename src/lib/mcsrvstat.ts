export interface Status {
	hostname: string;
	online: boolean;
	players: {
		online: number;
		max: number;
	};
	version: string;
}

const SERVER_HOSTNAME = "cs1a.sparked.network";

export async function getServerStatus(): Promise<Status> {
	const response = await fetch(
		`https://api.mcsrvstat.us/2/${SERVER_HOSTNAME}`,
		{
			headers: {
				"User-Agent": "jrwnnnn/block1a (ping@jrwnnnn.me)",
			},
		},
	);

	if (!response.ok) {
		throw new Error(
			`Failed to fetch server status: ${response.status} ${response.statusText}`,
		);
	}

	return await response.json();
}
